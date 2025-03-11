import 'dart:io';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:university_admission_app/providers/auth_provider.dart';
import 'package:university_admission_app/utils/app_routes.dart';
import 'package:university_admission_app/utils/validators.dart';
import 'package:university_admission_app/widgets/custom_button.dart';
import 'package:university_admission_app/widgets/input_field.dart';
import 'package:image_picker/image_picker.dart';

class ProfileScreen extends StatefulWidget {
  const ProfileScreen({super.key});

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  final _formKey = GlobalKey<FormState>();
  late TextEditingController _nameController;
  late TextEditingController _phoneController;
  File? _profileImage;
  final ImagePicker _picker = ImagePicker();
  bool _isEditing = false;

  @override
  void initState() {
    super.initState();
    final user = Provider.of<AuthProvider>(context, listen: false).user;
    _nameController = TextEditingController(text: user?.name ?? '');
    _phoneController = TextEditingController(text: user?.phone ?? '');
  }

  @override
  void dispose() {
    _nameController.dispose();
    _phoneController.dispose();
    super.dispose();
  }

  Future<void> _pickImage() async {
    final XFile? image = await _picker.pickImage(source: ImageSource.gallery);
    if (image != null) {
      setState(() {
        _profileImage = File(image.path);
      });
    }
  }

  Future<void> _updateProfile() async {
    if (_formKey.currentState?.validate() ?? false) {
      final authProvider = Provider.of<AuthProvider>(context, listen: false);

      await authProvider.updateProfile(
        name: _nameController.text.trim(),
        phone: _phoneController.text.trim(),
        profileImageUrl: _profileImage?.path,
      );

      if (authProvider.error == null && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('প্রোফাইল সফলভাবে আপডেট হয়েছে'),
            backgroundColor: Colors.green,
          ),
        );
        setState(() {
          _isEditing = false;
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final authProvider = Provider.of<AuthProvider>(context);
    final user = authProvider.user;

    if (user == null) {
      return Scaffold(
        appBar: AppBar(
          title: const Text('প্রোফাইল'),
        ),
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Text('আপনি লগইন করা নেই'),
              const SizedBox(height: 16),
              CustomButton(
                text: 'লগইন করুন',
                onPressed: () {
                  Navigator.of(context).pushReplacementNamed(AppRoutes.login);
                },
              ),
            ],
          ),
        ),
      );
    }

    return Scaffold(
      appBar: AppBar(
        title: const Text('প্রোফাইল'),
        actions: [
          IconButton(
            icon: Icon(_isEditing ? Icons.close : Icons.edit),
            onPressed: () {
              setState(() {
                _isEditing = !_isEditing;
                if (!_isEditing) {
                  _nameController.text = user.name;
                  _phoneController.text = user.phone;
                  _profileImage = null;
                }
              });
            },
          ),
        ],
      ),
      body: authProvider.isLoading
          ? const Center(child: CircularProgressIndicator())
          : SingleChildScrollView(
              padding: const EdgeInsets.all(16),
              child: _isEditing
                  ? _buildEditForm(authProvider)
                  : _buildProfileView(user),
            ),
    );
  }

  Widget _buildProfileView(user) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        const SizedBox(height: 16),
        Center(
          child: CircleAvatar(
            radius: 60,
            backgroundColor: Colors.blue.shade100,
            backgroundImage: user.profileImageUrl != null
                ? NetworkImage(user.profileImageUrl)
                : null,
            child: user.profileImageUrl == null
                ? Text(
                    user.name.isNotEmpty ? user.name[0].toUpperCase() : '?',
                    style: const TextStyle(
                      fontSize: 40,
                      fontWeight: FontWeight.bold,
                      color: Colors.blue,
                    ),
                  )
                : null,
          ),
        ),
        const SizedBox(height: 24),
        Text(
          user.name,
          style: const TextStyle(
            fontSize: 24,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        Text(
          user.role == 'student' ? 'শিক্ষার্থী' : user.role,
          style: TextStyle(
            fontSize: 16,
            color: Colors.grey.shade600,
          ),
        ),
        const SizedBox(height: 32),
        const Divider(),
        const SizedBox(height: 16),
        _buildInfoItem(Icons.email_outlined, 'ইমেইল', user.email),
        const SizedBox(height: 16),
        _buildInfoItem(Icons.phone_outlined, 'ফোন', user.phone),
        const SizedBox(height: 16),
        _buildInfoItem(
          Icons.calendar_today_outlined,
          'অ্যাকাউন্ট তৈরির তারিখ',
          '${user.createdAt.day}/${user.createdAt.month}/${user.createdAt.year}',
        ),
        const SizedBox(height: 32),
        CustomButton(
          text: 'লগআউট করুন',
          onPressed: () async {
            await Provider.of<AuthProvider>(context, listen: false).logout();
            if (mounted) {
              Navigator.of(context).pushReplacementNamed(AppRoutes.login);
            }
          },
          isOutlined: true,
          backgroundColor: Colors.red,
          textColor: Colors.red,
          icon: Icons.logout,
        ),
      ],
    );
  }

  Widget _buildEditForm(AuthProvider authProvider) {
    return Form(
      key: _formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          const SizedBox(height: 16),
          Center(
            child: Stack(
              children: [
                CircleAvatar(
                  radius: 60,
                  backgroundColor: Colors.blue.shade100,
                  backgroundImage: _profileImage != null
                      ? FileImage(_profileImage!)
                      : authProvider.user?.profileImageUrl != null
                          ? NetworkImage(authProvider.user!.profileImageUrl!)
                          : null,
                  child: _profileImage == null &&
                          authProvider.user?.profileImageUrl == null
                      ? Text(
                          authProvider.user?.name.isNotEmpty ?? false
                              ? authProvider.user!.name[0].toUpperCase()
                              : '?',
                          style: const TextStyle(
                            fontSize: 40,
                            fontWeight: FontWeight.bold,
                            color: Colors.blue,
                          ),
                        )
                      : null,
                ),
                Positioned(
                  bottom: 0,
                  right: 0,
                  child: Container(
                    decoration: BoxDecoration(
                      color: Colors.blue,
                      borderRadius: BorderRadius.circular(20),
                    ),
                    child: IconButton(
                      icon: const Icon(Icons.camera_alt, color: Colors.white),
                      onPressed: _pickImage,
                    ),
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 32),

          // Error message
          if (authProvider.error != null) ...[
            Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: Colors.red.shade50,
                borderRadius: BorderRadius.circular(8),
                border: Border.all(color: Colors.red.shade200),
              ),
              child: Text(
                authProvider.error!.replaceAll('Exception: ', ''),
                style: TextStyle(color: Colors.red.shade800),
              ),
            ),
            const SizedBox(height: 16),
          ],

          // Name field
          InputField(
            label: 'নাম',
            hint: 'আপনার পূর্ণ নাম লিখুন',
            controller: _nameController,
            validator: Validators.validateName,
            prefix: const Icon(Icons.person_outline),
          ),
          const SizedBox(height: 16),

          // Phone field
          InputField(
            label: 'ফোন নম্বর',
            hint: 'আপনার ফোন নম্বর লিখুন',
            controller: _phoneController,
            keyboardType: TextInputType.phone,
            validator: Validators.validatePhone,
            prefix: const Icon(Icons.phone_outlined),
          ),
          const SizedBox(height: 32),

          // Update button
          CustomButton(
            text: 'আপডেট করুন',
            onPressed: _updateProfile,
            isLoading: authProvider.isLoading,
          ),
        ],
      ),
    );
  }

  Widget _buildInfoItem(IconData icon, String label, String value) {
    return Row(
      children: [
        Icon(icon, color: Colors.blue),
        const SizedBox(width: 16),
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              label,
              style: TextStyle(
                fontSize: 14,
                color: Colors.grey.shade600,
              ),
            ),
            const SizedBox(height: 4),
            Text(
              value,
              style: const TextStyle(
                fontSize: 16,
              ),
            ),
          ],
        ),
      ],
    );
  }
}
