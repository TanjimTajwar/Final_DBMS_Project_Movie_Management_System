class ApplicationModel {
  final String id;
  final String studentId;
  final String universityId;
  final String programId;
  final String status; // pending, approved, rejected
  final Map<String, dynamic> academicInfo;
  final List<String> documents;
  final DateTime applicationDate;
  final DateTime? reviewDate;
  final String? reviewedBy;
  final String? remarks;

  ApplicationModel({
    required this.id,
    required this.studentId,
    required this.universityId,
    required this.programId,
    required this.status,
    required this.academicInfo,
    required this.documents,
    required this.applicationDate,
    this.reviewDate,
    this.reviewedBy,
    this.remarks,
  });

  factory ApplicationModel.fromJson(Map<String, dynamic> json) {
    return ApplicationModel(
      id: json['id'] ?? '',
      studentId: json['studentId'] ?? '',
      universityId: json['universityId'] ?? '',
      programId: json['programId'] ?? '',
      status: json['status'] ?? 'pending',
      academicInfo: json['academicInfo'] ?? {},
      documents: List<String>.from(json['documents'] ?? []),
      applicationDate: json['applicationDate'] != null
          ? DateTime.parse(json['applicationDate'])
          : DateTime.now(),
      reviewDate: json['reviewDate'] != null
          ? DateTime.parse(json['reviewDate'])
          : null,
      reviewedBy: json['reviewedBy'],
      remarks: json['remarks'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'studentId': studentId,
      'universityId': universityId,
      'programId': programId,
      'status': status,
      'academicInfo': academicInfo,
      'documents': documents,
      'applicationDate': applicationDate.toIso8601String(),
      'reviewDate': reviewDate?.toIso8601String(),
      'reviewedBy': reviewedBy,
      'remarks': remarks,
    };
  }

  ApplicationModel copyWith({
    String? id,
    String? studentId,
    String? universityId,
    String? programId,
    String? status,
    Map<String, dynamic>? academicInfo,
    List<String>? documents,
    DateTime? applicationDate,
    DateTime? reviewDate,
    String? reviewedBy,
    String? remarks,
  }) {
    return ApplicationModel(
      id: id ?? this.id,
      studentId: studentId ?? this.studentId,
      universityId: universityId ?? this.universityId,
      programId: programId ?? this.programId,
      status: status ?? this.status,
      academicInfo: academicInfo ?? this.academicInfo,
      documents: documents ?? this.documents,
      applicationDate: applicationDate ?? this.applicationDate,
      reviewDate: reviewDate ?? this.reviewDate,
      reviewedBy: reviewedBy ?? this.reviewedBy,
      remarks: remarks ?? this.remarks,
    );
  }
} 