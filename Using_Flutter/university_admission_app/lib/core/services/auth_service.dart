import 'package:university_admission_app/models/user_model.dart';

// Singleton pattern implementation
class AuthService {
  static final AuthService _instance = AuthService._internal();
  
  factory AuthService() {
    return _instance;
  }
  
  AuthService._internal();
  
  // Mock data for demonstration
  final Map<String, UserModel> _users = {};
  UserModel? _currentUser;
  
  // Get current user
  UserModel? get currentUser => _currentUser;
  
  // Register user
  Future<UserModel> register({
    required String name,
    required String email,
    required String password,
    required String phone,
  }) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    // Check if user already exists
    if (_users.containsKey(email)) {
      throw Exception('ইমেইল ইতিমধ্যে ব্যবহৃত হয়েছে');
    }
    
    // Create new user
    final user = UserModel(
      id: DateTime.now().millisecondsSinceEpoch.toString(),
      name: name,
      email: email,
      phone: phone,
      role: 'student',
      createdAt: DateTime.now(),
      updatedAt: DateTime.now(),
    );
    
    // Save user
    _users[email] = user;
    _currentUser = user;
    
    return user;
  }
  
  // Login user
  Future<UserModel> login({
    required String email,
    required String password,
  }) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    // Check if user exists
    if (!_users.containsKey(email)) {
      throw Exception('ইমেইল বা পাসওয়ার্ড ভুল');
    }
    
    // Get user
    final user = _users[email]!;
    _currentUser = user;
    
    return user;
  }
  
  // Logout user
  Future<void> logout() async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    _currentUser = null;
  }
  
  // Check if user is logged in
  bool isLoggedIn() {
    return _currentUser != null;
  }
  
  // Update user profile
  Future<UserModel> updateProfile({
    required String name,
    required String phone,
    String? profileImageUrl,
  }) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    if (_currentUser == null) {
      throw Exception('ব্যবহারকারী লগইন করা নেই');
    }
    
    // Update user
    final updatedUser = _currentUser!.copyWith(
      name: name,
      phone: phone,
      profileImageUrl: profileImageUrl,
      updatedAt: DateTime.now(),
    );
    
    // Save user
    _users[updatedUser.email] = updatedUser;
    _currentUser = updatedUser;
    
    return updatedUser;
  }
} 