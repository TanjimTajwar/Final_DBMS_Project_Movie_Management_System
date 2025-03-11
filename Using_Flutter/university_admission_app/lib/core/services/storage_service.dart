import 'dart:io';

// Singleton pattern implementation
class StorageService {
  static final StorageService _instance = StorageService._internal();
  
  factory StorageService() {
    return _instance;
  }
  
  StorageService._internal();
  
  // Mock data for demonstration
  final Map<String, String> _files = {};
  
  // Upload file
  Future<String> uploadFile(File file, String path) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 2));
    
    // Generate file name
    final fileName = '${DateTime.now().millisecondsSinceEpoch}_${file.path.split('/').last}';
    final fullPath = '$path/$fileName';
    
    // Save file
    _files[fullPath] = file.path;
    
    return fullPath;
  }
  
  // Upload multiple files
  Future<List<String>> uploadFiles(List<File> files, String path) async {
    final uploadedFiles = <String>[];
    
    for (final file in files) {
      final uploadedFile = await uploadFile(file, path);
      uploadedFiles.add(uploadedFile);
    }
    
    return uploadedFiles;
  }
  
  // Delete file
  Future<void> deleteFile(String path) async {
    // Simulate API delay
    await Future.delayed(const Duration(seconds: 1));
    
    _files.remove(path);
  }
  
  // Get file URL
  String getFileUrl(String path) {
    return 'https://example.com/storage/$path';
  }
} 