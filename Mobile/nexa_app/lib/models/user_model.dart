class UserModel {
  String nome;
  String email;
  String senha;
  String telefone;
  String cpf;
  String dataNascimento;
  String uidRfid;
  String epis;
  String role; // user ou admin

  UserModel({
    required this.nome,
    required this.email,
    required this.senha,
    required this.telefone,
    required this.cpf,
    required this.dataNascimento,
    required this.uidRfid,
    required this.epis,
    required this.role,
  });
}

UserModel usuarioLogado = UserModel(
  nome: "Fun NEXA",
  email: "fun@nexa.com",
  senha: "123456",
  telefone: "(19) 99999-9999",
  cpf: "000.000.000-00",
  dataNascimento: "01/01/1990",
  uidRfid: "RFID-984523",
  epis: "Capacete, Luvas",
  role: "funcionário",
);


class admModel {
  String admnome;
  String admemail;
  String admsenha;
  String admtelefone;
  String admcpf;
  String admdataNascimento;
  String role; // user ou admin

  admModel({
    required this.admnome,
    required this.admemail,
    required this.admsenha,
    required this.admtelefone,
    required this.admcpf,
    required this.admdataNascimento,
    required this.role,
  });
}


admModel admLogado = admModel(
  admnome: "admin NEXA",
  admemail: "admin@nexa.com",
  admsenha: "123456",
  admtelefone: "(19) 99999-9999",
  admcpf: "000.000.000-00",
  admdataNascimento: "01/01/1990",
  role: "admin",
);
