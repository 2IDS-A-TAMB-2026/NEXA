class EpiModel {
  final int id;
  final String nome;
  final String imagem;
  final String descricao;

  EpiModel({
    required this.id,
    required this.nome,
    required this.imagem,
    required this.descricao,
  });

  factory EpiModel.fromJson(Map<String, dynamic> json) {
    return EpiModel(
      id: int.tryParse(
            json['ID']?.toString() ??
                json['id']?.toString() ??
                '0',
          ) ??
          0,
      nome: json['NOME_EPI']?.toString() ??
          json['nome']?.toString() ??
          '',
      imagem: json['IMAGEM_EPI']?.toString() ??
          json['imagem']?.toString() ??
          '',
      descricao: json['DESCRICAO_EPI']?.toString() ??
          json['descricao']?.toString() ??
          '',
    );
  }
}