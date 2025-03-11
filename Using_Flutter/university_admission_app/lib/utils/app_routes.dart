import 'package:flutter/material.dart';
import 'package:university_admission_app/screens/auth/login_screen.dart';
import 'package:university_admission_app/screens/auth/register_screen.dart';
import 'package:university_admission_app/screens/home/home_screen.dart';
import 'package:university_admission_app/screens/home/application_screen.dart';
import 'package:university_admission_app/screens/home/profile_screen.dart';

class AppRoutes {
  static const String login = '/login';
  static const String register = '/register';
  static const String home = '/home';
  static const String application = '/application';
  static const String profile = '/profile';

  static Map<String, WidgetBuilder> get routes => {
        login: (context) => const LoginScreen(),
        register: (context) => const RegisterScreen(),
        home: (context) => const HomeScreen(),
        application: (context) => const ApplicationScreen(),
        profile: (context) => const ProfileScreen(),
      };
} 