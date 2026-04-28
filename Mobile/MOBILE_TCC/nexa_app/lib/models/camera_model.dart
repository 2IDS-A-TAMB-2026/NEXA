class UserModel {
  String nome;
  String cpf;
  String email;
  String telefone;
  String senha;
  String tipo; // admin ou funcionario

  UserModel({
    required this.nome,
    required this.cpf,
    required this.email,
    required this.telefone,
    required this.senha,
    required this.tipo,
  });
}