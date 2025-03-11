import 'dart:io';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:university_admission_app/providers/application_provider.dart';
import 'package:university_admission_app/providers/auth_provider.dart';
import 'package:university_admission_app/widgets/custom_button.dart';
import 'package:university_admission_app/widgets/input_field.dart';
import 'package:image_picker/image_picker.dart';

class ApplicationScreen extends StatefulWidget {
  const ApplicationScreen({super.key});

  @override
  State<ApplicationScreen> createState() => _ApplicationScreenState();
}

class _ApplicationScreenState extends State<ApplicationScreen> {
  final _formKey = GlobalKey<FormState>();
  final _sscGpaController = TextEditingController();
  final _hscGpaController = TextEditingController();
  final _sscBoardController = TextEditingController();
  final _hscBoardController = TextEditingController();
  final _sscYearController = TextEditingController();
  final _hscYearController = TextEditingController();
  final List<File> _documents = [];
  final ImagePicker _picker = ImagePicker();

  @override
  void dispose() {
    _sscGpaController.dispose();
    _hscGpaController.dispose();
    _sscBoardController.dispose();
    _hscBoardController.dispose();
    _sscYearController.dispose();
    _hscYearController.dispose();
    super.dispose();
  }

  Future<void> _pickDocument() async {
    final XFile? image = await _picker.pickImage(source: ImageSource.gallery);
    if (image != null) {
      setState(() {
        _documents.add(File(image.path));
      });
    }
  }

  void _removeDocument(int index) {
    setState(() {
      _documents.removeAt(index);
    });
  }

  Future<void> _submitApplication() async {
    if (_formKey.currentState?.validate() ?? false) {
      if (_documents.isEmpty) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('কমপক্ষে একটি ডকুমেন্ট আপলোড করুন'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      final authProvider = Provider.of<AuthProvider>(context, listen: false);
      final applicationProvider =
          Provider.of<ApplicationProvider>(context, listen: false);

      if (authProvider.user == null) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('আপনি লগইন করা নেই'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      final academicInfo = {
        'ssc': {
          'gpa': _sscGpaController.text,
          'board': _sscBoardController.text,
          'year': _sscYearController.text,
        },
        'hsc': {
          'gpa': _hscGpaController.text,
          'board': _hscBoardController.text,
          'year': _hscYearController.text,
        },
      };

      await applicationProvider.submitApplication(
        studentId: authProvider.user!.id,
        academicInfo: academicInfo,
        documents: _documents,
      );

      if (applicationProvider.error == null && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('আবেদন সফলভাবে জমা হয়েছে'),
            backgroundColor: Colors.green,
          ),
        );
        Navigator.of(context).pop();
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final applicationProvider = Provider.of<ApplicationProvider>(context);

    if (applicationProvider.selectedUniversity == null) {
      return Scaffold(
        appBar: AppBar(
          title: const Text('আবেদন'),
        ),
        body: const Center(
          child: Text('কোন বিশ্ববিদ্যালয় নির্বাচন করা হয়নি'),
        ),
      );
    }

    return Scaffold(
      appBar: AppBar(
        title: Text(applicationProvider.selectedUniversity!['name']),
      ),
      body: applicationProvider.isLoading
          ? const Center(child: CircularProgressIndicator())
          : applicationProvider.error != null
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        applicationProvider.error!
                            .replaceAll('Exception: ', ''),
                        style: TextStyle(color: Colors.red.shade800),
                      ),
                      const SizedBox(height: 16),
                      CustomButton(
                        text: 'আবার চেষ্টা করুন',
                        onPressed: () {
                          applicationProvider.selectUniversity(
                            applicationProvider.selectedUniversity!['id'],
                          );
                        },
                      ),
                    ],
                  ),
                )
              : SingleChildScrollView(
                  padding: const EdgeInsets.all(16),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      // University info
                      Card(
                        child: Padding(
                          padding: const EdgeInsets.all(16),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const Text(
                                'বিশ্ববিদ্যালয় তথ্য',
                                style: TextStyle(
                                  fontSize: 18,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              const SizedBox(height: 16),
                              _buildInfoRow(
                                'নাম',
                                applicationProvider.selectedUniversity!['name'],
                              ),
                              const SizedBox(height: 8),
                              _buildInfoRow(
                                'অবস্থান',
                                applicationProvider
                                    .selectedUniversity!['location'],
                              ),
                              const SizedBox(height: 8),
                              _buildInfoRow(
                                'প্রতিষ্ঠিত',
                                applicationProvider
                                    .selectedUniversity!['established'],
                              ),
                              const SizedBox(height: 8),
                              _buildInfoRow(
                                'ধরন',
                                applicationProvider.selectedUniversity!['type'],
                              ),
                            ],
                          ),
                        ),
                      ),
                      const SizedBox(height: 16),

                      // Programs
                      const Text(
                        'প্রোগ্রামসমূহ',
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 16),
                      ...applicationProvider.programs.map((program) {
                        final isSelected =
                            applicationProvider.selectedProgram != null &&
                                applicationProvider.selectedProgram!['id'] ==
                                    program['id'];

                        return Card(
                          margin: const EdgeInsets.only(bottom: 16),
                          color: isSelected ? Colors.blue.shade50 : null,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(8),
                            side: BorderSide(
                              color:
                                  isSelected ? Colors.blue : Colors.transparent,
                              width: 2,
                            ),
                          ),
                          child: InkWell(
                            onTap: () {
                              applicationProvider.selectProgram(program['id']);
                            },
                            child: Padding(
                              padding: const EdgeInsets.all(16),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    program['name'],
                                    style: const TextStyle(
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  const SizedBox(height: 8),
                                  _buildInfoRow('ডিগ্রি', program['degree']),
                                  const SizedBox(height: 4),
                                  _buildInfoRow('সময়কাল', program['duration']),
                                  const SizedBox(height: 4),
                                  _buildInfoRow('ক্রেডিট', program['credits']),
                                  const SizedBox(height: 4),
                                  _buildInfoRow(
                                      'টিউশন ফি', program['tuitionFees']),
                                ],
                              ),
                            ),
                          ),
                        );
                      }).toList(),

                      // Application form
                      if (applicationProvider.selectedProgram != null) ...[
                        const SizedBox(height: 16),
                        const Text(
                          'আবেদন ফর্ম',
                          style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 16),
                        Form(
                          key: _formKey,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              // Academic info
                              const Text(
                                'একাডেমিক তথ্য',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              const SizedBox(height: 16),

                              // SSC info
                              const Text(
                                'এসএসসি',
                                style: TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                              const SizedBox(height: 8),
                              Row(
                                children: [
                                  Expanded(
                                    child: InputField(
                                      label: 'জিপিএ',
                                      hint: '5.00',
                                      controller: _sscGpaController,
                                      keyboardType: TextInputType.number,
                                      validator: (value) {
                                        if (value == null || value.isEmpty) {
                                          return 'জিপিএ প্রয়োজন';
                                        }

                                        final gpa = double.tryParse(value);
                                        if (gpa == null || gpa < 0 || gpa > 5) {
                                          return 'সঠিক জিপিএ দিন';
                                        }

                                        return null;
                                      },
                                    ),
                                  ),
                                  const SizedBox(width: 16),
                                  Expanded(
                                    child: InputField(
                                      label: 'বোর্ড',
                                      hint: 'ঢাকা',
                                      controller: _sscBoardController,
                                      validator: (value) {
                                        if (value == null || value.isEmpty) {
                                          return 'বোর্ড প্রয়োজন';
                                        }

                                        return null;
                                      },
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 16),
                              InputField(
                                label: 'পাসের বছর',
                                hint: '2018',
                                controller: _sscYearController,
                                keyboardType: TextInputType.number,
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'পাসের বছর প্রয়োজন';
                                  }

                                  final year = int.tryParse(value);
                                  if (year == null ||
                                      year < 1990 ||
                                      year > DateTime.now().year) {
                                    return 'সঠিক বছর দিন';
                                  }

                                  return null;
                                },
                              ),
                              const SizedBox(height: 24),

                              // HSC info
                              const Text(
                                'এইচএসসি',
                                style: TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                              const SizedBox(height: 8),
                              Row(
                                children: [
                                  Expanded(
                                    child: InputField(
                                      label: 'জিপিএ',
                                      hint: '5.00',
                                      controller: _hscGpaController,
                                      keyboardType: TextInputType.number,
                                      validator: (value) {
                                        if (value == null || value.isEmpty) {
                                          return 'জিপিএ প্রয়োজন';
                                        }

                                        final gpa = double.tryParse(value);
                                        if (gpa == null || gpa < 0 || gpa > 5) {
                                          return 'সঠিক জিপিএ দিন';
                                        }

                                        return null;
                                      },
                                    ),
                                  ),
                                  const SizedBox(width: 16),
                                  Expanded(
                                    child: InputField(
                                      label: 'বোর্ড',
                                      hint: 'ঢাকা',
                                      controller: _hscBoardController,
                                      validator: (value) {
                                        if (value == null || value.isEmpty) {
                                          return 'বোর্ড প্রয়োজন';
                                        }

                                        return null;
                                      },
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 16),
                              InputField(
                                label: 'পাসের বছর',
                                hint: '2020',
                                controller: _hscYearController,
                                keyboardType: TextInputType.number,
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'পাসের বছর প্রয়োজন';
                                  }

                                  final year = int.tryParse(value);
                                  if (year == null ||
                                      year < 1990 ||
                                      year > DateTime.now().year) {
                                    return 'সঠিক বছর দিন';
                                  }

                                  return null;
                                },
                              ),
                              const SizedBox(height: 24),

                              // Documents
                              const Text(
                                'ডকুমেন্টস',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              const SizedBox(height: 8),
                              const Text(
                                'এসএসসি ও এইচএসসি সার্টিফিকেট, মার্কশিট এবং অন্যান্য প্রয়োজনীয় ডকুমেন্ট আপলোড করুন',
                                style: TextStyle(
                                  fontSize: 14,
                                  color: Colors.grey,
                                ),
                              ),
                              const SizedBox(height: 16),

                              // Document list
                              if (_documents.isNotEmpty) ...[
                                ListView.builder(
                                  shrinkWrap: true,
                                  physics: const NeverScrollableScrollPhysics(),
                                  itemCount: _documents.length,
                                  itemBuilder: (context, index) {
                                    return Card(
                                      margin: const EdgeInsets.only(bottom: 8),
                                      child: ListTile(
                                        leading: const Icon(Icons.file_present),
                                        title: Text(
                                          _documents[index]
                                              .path
                                              .split('/')
                                              .last,
                                          maxLines: 1,
                                          overflow: TextOverflow.ellipsis,
                                        ),
                                        trailing: IconButton(
                                          icon: const Icon(Icons.delete,
                                              color: Colors.red),
                                          onPressed: () =>
                                              _removeDocument(index),
                                        ),
                                      ),
                                    );
                                  },
                                ),
                                const SizedBox(height: 16),
                              ],

                              // Add document button
                              CustomButton(
                                text: 'ডকুমেন্ট যোগ করুন',
                                onPressed: _pickDocument,
                                isOutlined: true,
                                icon: Icons.upload_file,
                              ),
                              const SizedBox(height: 32),

                              // Submit button
                              CustomButton(
                                text: 'আবেদন জমা দিন',
                                onPressed: _submitApplication,
                                isLoading: applicationProvider.isLoading,
                              ),
                            ],
                          ),
                        ),
                      ],
                    ],
                  ),
                ),
    );
  }

  Widget _buildInfoRow(String label, String value) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(
          '$label:',
          style: const TextStyle(
            fontWeight: FontWeight.w500,
          ),
        ),
        Text(value),
      ],
    );
  }
}
