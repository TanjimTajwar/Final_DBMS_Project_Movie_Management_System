import 'dart:io';
import 'package:flutter/material.dart';
import 'package:university_admission_app/core/services/database_service.dart';
import 'package:university_admission_app/core/services/storage_service.dart';
import 'package:university_admission_app/models/application_model.dart';

// Observer pattern implementation
class ApplicationProvider extends ChangeNotifier {
  final DatabaseService _databaseService = DatabaseService();
  final StorageService _storageService = StorageService();
  
  List<ApplicationModel> _applications = [];
  List<Map<String, dynamic>> _universities = [];
  Map<String, dynamic>? _selectedUniversity;
  List<Map<String, dynamic>> _programs = [];
  Map<String, dynamic>? _selectedProgram;
  ApplicationModel? _selectedApplication;
  
  bool _isLoading = false;
  String? _error;
  
  // Getters
  List<ApplicationModel> get applications => _applications;
  List<Map<String, dynamic>> get universities => _universities;
  Map<String, dynamic>? get selectedUniversity => _selectedUniversity;
  List<Map<String, dynamic>> get programs => _programs;
  Map<String, dynamic>? get selectedProgram => _selectedProgram;
  ApplicationModel? get selectedApplication => _selectedApplication;
  bool get isLoading => _isLoading;
  String? get error => _error;
  
  // Load universities
  Future<void> loadUniversities() async {
    _isLoading = true;
    _error = null;
    notifyListeners();
    
    try {
      _universities = await _databaseService.getUniversities();
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Select university
  Future<void> selectUniversity(String universityId) async {
    _isLoading = true;
    _error = null;
    _selectedUniversity = null;
    _programs = [];
    _selectedProgram = null;
    notifyListeners();
    
    try {
      _selectedUniversity = await _databaseService.getUniversityById(universityId);
      _programs = await _databaseService.getProgramsByUniversityId(universityId);
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Select program
  Future<void> selectProgram(String programId) async {
    _isLoading = true;
    _error = null;
    _selectedProgram = null;
    notifyListeners();
    
    try {
      if (_selectedUniversity != null) {
        _selectedProgram = await _databaseService.getProgramById(
          _selectedUniversity!['id'],
          programId,
        );
      } else {
        throw Exception('বিশ্ববিদ্যালয় নির্বাচন করুন');
      }
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Submit application
  Future<void> submitApplication({
    required String studentId,
    required Map<String, dynamic> academicInfo,
    required List<File> documents,
  }) async {
    _isLoading = true;
    _error = null;
    notifyListeners();
    
    try {
      if (_selectedUniversity == null || _selectedProgram == null) {
        throw Exception('বিশ্ববিদ্যালয় এবং প্রোগ্রাম নির্বাচন করুন');
      }
      
      // Upload documents
      final uploadedDocuments = await _storageService.uploadFiles(
        documents,
        'applications/$studentId',
      );
      
      // Submit application
      final application = await _databaseService.submitApplication(
        studentId: studentId,
        universityId: _selectedUniversity!['id'],
        programId: _selectedProgram!['id'],
        academicInfo: academicInfo,
        documents: uploadedDocuments,
      );
      
      _applications.add(application);
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Load applications
  Future<void> loadApplications(String studentId) async {
    _isLoading = true;
    _error = null;
    notifyListeners();
    
    try {
      _applications = await _databaseService.getApplicationsByStudentId(studentId);
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Get application details
  Future<void> getApplicationDetails(String applicationId) async {
    _isLoading = true;
    _error = null;
    _selectedApplication = null;
    notifyListeners();
    
    try {
      _selectedApplication = await _databaseService.getApplicationById(applicationId);
      
      // Load university and program details
      _selectedUniversity = await _databaseService.getUniversityById(
        _selectedApplication!.universityId,
      );
      
      _programs = await _databaseService.getProgramsByUniversityId(
        _selectedApplication!.universityId,
      );
      
      _selectedProgram = await _databaseService.getProgramById(
        _selectedApplication!.universityId,
        _selectedApplication!.programId,
      );
    } catch (e) {
      _error = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
  
  // Clear error
  void clearError() {
    _error = null;
    notifyListeners();
  }
  
  // Reset selection
  void resetSelection() {
    _selectedUniversity = null;
    _programs = [];
    _selectedProgram = null;
    _selectedApplication = null;
    notifyListeners();
  }
} 