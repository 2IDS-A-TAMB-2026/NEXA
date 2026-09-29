class CameraModel {
  final int id;
  final String identificador;
  final String status;
  final int? idSetor;
  final String? cnpjEmpresa;

  CameraModel({
    required this.id,
    required this.identificador,
    required this.status,
    this.idSetor,
    this.cnpjEmpresa,
  });

  factory CameraModel.fromJson(Map<String, dynamic> json) {
    return CameraModel(
      id: int.parse(json['ID'].toString()),
      identificador: json['IDENTIFICADOR_CAMERA']?.toString() ?? '',
      status: json['STATUS']?.toString() ?? '',
      idSetor: json['FK_ID_SETOR'] != null
          ? int.tryParse(json['FK_ID_SETOR'].toString())
          : null,
      cnpjEmpresa: json['FK_CNPJ_EMPRESA']?.toString(),
    );
  }
}