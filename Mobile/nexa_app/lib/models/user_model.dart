import 'epi_model.dart';

class UserModel {
  String nome;
  String email;
  String senha;
  String telefone;
  String cpf;
  String dataNascimento;
  String uidRfid;

  // Lista completa dos EPIs obrigatórios
  List<EpiModel> episObrigatorios;

  String role;
  String empresa;
  String setor;
  String cnpjEmpresa;
  String idSetor;

  UserModel({
    required this.nome,
    required this.email,
    required this.senha,
    required this.telefone,
    required this.cpf,
    required this.dataNascimento,
    required this.uidRfid,
    required this.episObrigatorios,
    required this.role,
    this.empresa = '',
    this.setor = '',
    this.cnpjEmpresa = '',
    this.idSetor = '',
  });

  // =========================================================
  // NOMES DOS EPIs
  // =========================================================

  String get epis {
    if (episObrigatorios.isEmpty) {
      return '';
    }

    return episObrigatorios
        .map((epi) => epi.nome)
        .where((nome) => nome.isNotEmpty)
        .join(', ');
  }

  // =========================================================
  // JSON
  // =========================================================

  factory UserModel.fromJson(
    Map<String, dynamic> json,
  ) {
    final listaEpis = <EpiModel>[];

    final episJson = json['EPIS'] ?? json['epis'];

    if (episJson is List) {
      for (final item in episJson) {
        if (item is Map) {
          listaEpis.add(
            EpiModel.fromJson(
              Map<String, dynamic>.from(item),
            ),
          );
        }
      }
    }

    return UserModel(
      nome: json['nome']?.toString() ??
          json['NOME_COMPLETO']?.toString() ??
          '',

      email: json['email']?.toString() ??
          json['EMAIL_CORPORATIVO']?.toString() ??
          '',

      senha: json['senha']?.toString() ?? '',

      telefone: json['telefone']?.toString() ??
          json['TELEFONE']?.toString() ??
          '',

      cpf: json['cpf']?.toString() ??
          json['CPF']?.toString() ??
          '',

      dataNascimento:
          json['dataNascimento']?.toString() ??
              json['DATA_NASCIMENTO']?.toString() ??
              '',

      uidRfid:
          json['uidRfid']?.toString() ??
              json['UID_RFID']?.toString() ??
              '',

      episObrigatorios: listaEpis,

      role: json['role']?.toString() ??
          'funcionário',

      empresa: json['empresa']?.toString() ??
          json['EMPRESA']?.toString() ??
          '',

      setor: json['setor']?.toString() ??
          json['SETOR']?.toString() ??
          '',

      cnpjEmpresa:
          json['cnpjEmpresa']?.toString() ??
              json['FK_CNPJ_EMPRESA']?.toString() ??
              '',

      idSetor:
          json['idSetor']?.toString() ??
              json['FK_ID_SETOR']?.toString() ??
              '',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'nome': nome,
      'email': email,
      'senha': senha,
      'telefone': telefone,
      'cpf': cpf,
      'dataNascimento': dataNascimento,
      'uidRfid': uidRfid,
      'epis': episObrigatorios
          .map((epi) => {
                'ID': epi.id,
                'NOME_EPI': epi.nome,
                'IMAGEM_EPI': epi.imagem,
                'DESCRICAO_EPI': epi.descricao,
              })
          .toList(),
      'role': role,
      'empresa': empresa,
      'setor': setor,
      'cnpjEmpresa': cnpjEmpresa,
      'idSetor': idSetor,
    };
  }
}


// =========================================================
// USUÁRIO LOGADO
// =========================================================

UserModel usuarioLogado = UserModel(
  nome: '',
  email: '',
  senha: '',
  telefone: '',
  cpf: '',
  dataNascimento: '',
  uidRfid: '',
  episObrigatorios: [],
  role: 'funcionário',
  empresa: '',
  setor: '',
  cnpjEmpresa: '',
  idSetor: '',
);