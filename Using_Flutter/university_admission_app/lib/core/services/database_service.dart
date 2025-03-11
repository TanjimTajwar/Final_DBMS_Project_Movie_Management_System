import 'package:university_admission_app/models/application_model.dart';

// Singleton pattern implementation
class DatabaseService {
  static final DatabaseService _instance = DatabaseService._internal();
  
  factory DatabaseService() {
    return _instance;
  }
  
  DatabaseService._internal();
  
  // Mock data for demonstration
  final List<ApplicationModel> _applications = [];
  final List<Map<String, dynamic>> _universities = [
    {
      'id': '1',
      'name': 'ঢাকা বিশ্ববিদ্যালয়',
      'shortName': 'ঢাবি',
      'location': 'ঢাকা',
      'established': '1921',
      'type': 'পাবলিক',
      'website': 'https://www.du.ac.bd',
      'logo': 'assets/images/du_logo.png',
      'programs': [
        {
          'id': '1',
          'name': 'কম্পিউটার সায়েন্স এন্ড ইঞ্জিনিয়ারিং',
          'degree': 'বিএসসি',
          'duration': '4 বছর',
          'credits': '160',
          'tuitionFees': '৳ 8,000/সেমিস্টার',
        },
        {
          'id': '2',
          'name': 'ইলেকট্রিক্যাল এন্ড ইলেকট্রনিক ইঞ্জিনিয়ারিং',
          'degree': 'বিএসসি',
          'duration': '4 বছর',
          'credits': '160',
          'tuitionFees': '৳ 8,000/সেমিস্টার',
        },
      ],
    },
    {
      'id': '2',
      'name': 'বাংলাদেশ প্রকৌশল বিশ্ববিদ্যালয়',
      'shortName': 'বুয়েট',
      'location': 'ঢাকা',
      'established': '1962',
      'type': 'পাবলিক',
      'website': 'https://www.buet.ac.bd',
      'logo': 'assets/images/buet_logo.png',
      'programs': [
        {
          'id': '3',
          'name': 'কম্পিউটার সায়েন্স এন্ড ইঞ্জিনিয়ারিং',
          'degree': 'বিএসসি',
          'duration': '4 বছর',
          'credits': '160',
          'tuitionFees': '৳ 8,000/সেমিস্টার',
        },
        {
          'id': '4',
          'name': 'ইলেকট্রিক্যাল এন্ড ইলেকট্রনিক ইঞ্জিনিয়ারিং',
          'degree': 'বিএসসি',
          'duration': '4 বছর',
          'credits': '160',
          'tuitionFees': '৳ 8,000/সেমিস্টার',
        },
      ],
    },
  ];
  
  // Get all universities
  Future<List<Map<String, dynamic>>> getUniversities() async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    return _universities;
  }
  
  // Get university by id
  Future<Map<String, dynamic>> getUniversityById(String id) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    final university = _universities.firstWhere(
      (university) => university['id'] == id,
      orElse: () => throw Exception('বিশ্ববিদ্যালয় পাওয়া যায়নি'),
    );
    
    return university;
  }
  
  // Get programs by university id
  Future<List<Map<String, dynamic>>> getProgramsByUniversityId(String universityId) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    final university = await getUniversityById(universityId);
    
    return List<Map<String, dynamic>>.from(university['programs']);
  }
  
  // Get program by id
  Future<Map<String, dynamic>> getProgramById(String universityId, String programId) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    final programs = await getProgramsByUniversityId(universityId);
    
    final program = programs.firstWhere(
      (program) => program['id'] == programId,
      orElse: () => throw Exception('প্রোগ্রাম পাওয়া যায়নি'),
    );
    
    return program;
  }
  
  // Submit application
  Future<ApplicationModel> submitApplication({
    required String studentId,
    required String universityId,
    required String programId,
    required Map<String, dynamic> academicInfo,
    required List<String> documents,
  }) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    // Create application
    final application = ApplicationModel(
      id: DateTime.now().millisecondsSinceEpoch.toString(),
      studentId: studentId,
      universityId: universityId,
      programId: programId,
      status: 'pending',
      academicInfo: academicInfo,
      documents: documents,
      applicationDate: DateTime.now(),
    );
    
    // Save application
    _applications.add(application);
    
    return application;
  }
  
  // Get applications by student id
  Future<List<ApplicationModel>> getApplicationsByStudentId(String studentId) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    return _applications.where((application) => application.studentId == studentId).toList();
  }
  
  // Get application by id
  Future<ApplicationModel> getApplicationById(String id) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    final application = _applications.firstWhere(
      (application) => application.id == id,
      orElse: () => throw Exception('আবেদন পাওয়া যায়নি'),
    );
    
    return application;
  }
} 