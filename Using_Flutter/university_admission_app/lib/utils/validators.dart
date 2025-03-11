class Validators {
  static String? validateEmail(String? value) {
    if (value == null || value.isEmpty) {
      return 'ইমেইল প্রয়োজন';
    }
    
    final emailRegExp = RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$');
    if (!emailRegExp.hasMatch(value)) {
      return 'সঠিক ইমেইল দিন';
    }
    
    return null;
  }

  static String? validatePassword(String? value) {
    if (value == null || value.isEmpty) {
      return 'পাসওয়ার্ড প্রয়োজন';
    }
    
    if (value.length < 6) {
      return 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে';
    }
    
    return null;
  }

  static String? validateName(String? value) {
    if (value == null || value.isEmpty) {
      return 'নাম প্রয়োজন';
    }
    
    return null;
  }

  static String? validatePhone(String? value) {
    if (value == null || value.isEmpty) {
      return 'ফোন নম্বর প্রয়োজন';
    }
    
    final phoneRegExp = RegExp(r'^01[3-9]\d{8}$');
    if (!phoneRegExp.hasMatch(value)) {
      return 'সঠিক বাংলাদেশী ফোন নম্বর দিন';
    }
    
    return null;
  }

  static String? validateRequired(String? value, String fieldName) {
    if (value == null || value.isEmpty) {
      return '$fieldName প্রয়োজন';
    }
    
    return null;
  }
} 