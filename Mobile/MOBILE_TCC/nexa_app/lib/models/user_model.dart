class UserModel {
  String nome;
  String email;
  String senha;
  String telefone;
  String cpf;
  String dataNascimento;
  String tipoPerfil;
  String uidRfid;
  String epis;
  String? tipo;

  UserModel({
    required this.nome,
    required this.email,
    required this.senha,
    required this.telefone,
    required this.cpf,
    required this.dataNascimento,
    required this.tipoPerfil,
    required this.uidRfid,
    required this.epis,
    required this.tipo,
  });
}