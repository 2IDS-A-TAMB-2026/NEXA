class DashboardFunModel {
  final FuncionarioDashboard funcionario;
  final DashboardEpis epis;
  final DashboardOcorrencias ocorrencias;
  final List<DashboardCamera> cameras;

  DashboardFunModel({
    required this.funcionario,
    required this.epis,
    required this.ocorrencias,
    required this.cameras,
  });

  factory DashboardFunModel.fromJson(
    Map<String, dynamic> json,
  ) {
    return DashboardFunModel(
      funcionario: FuncionarioDashboard.fromJson(
        json['funcionario'] ?? {},
      ),
      epis: DashboardEpis.fromJson(
        json['epis'] ?? {},
      ),
      ocorrencias: DashboardOcorrencias.fromJson(
        json['ocorrencias'] ?? {},
      ),
      cameras: (json['cameras'] as List? ?? [])
          .map(
            (camera) => DashboardCamera.fromJson(
              camera,
            ),
          )
          .toList(),
    );
  }
}

// =========================================================
// FUNCIONÁRIO
// =========================================================

class FuncionarioDashboard {
  final String cpf;
  final String nome;
  final String email;
  final String telefone;
  final String uidRfid;
  final String cnpj;
  final String empresa;
  final String setor;
  final String localSetor;
  final dynamic setorId;

  FuncionarioDashboard({
    required this.cpf,
    required this.nome,
    required this.email,
    required this.telefone,
    required this.uidRfid,
    required this.cnpj,
    required this.empresa,
    required this.setor,
    required this.localSetor,
    required this.setorId,
  });

  factory FuncionarioDashboard.fromJson(
    Map<String, dynamic> json,
  ) {
    return FuncionarioDashboard(
      cpf: '${json['CPF'] ?? ''}',
      nome: '${json['NOME_COMPLETO'] ?? ''}',
      email: '${json['EMAIL_CORPORATIVO'] ?? ''}',
      telefone: '${json['TELEFONE'] ?? ''}',
      uidRfid: '${json['UID_RFID'] ?? ''}',
      cnpj: '${json['CNPJ'] ?? ''}',
      empresa: '${json['EMPRESA'] ?? ''}',
      setor: '${json['SETOR'] ?? ''}',
      localSetor: '${json['LOCAL_SETOR'] ?? ''}',
      setorId: json['SETOR_ID'],
    );
  }
}

// =========================================================
// EPI
// =========================================================

class DashboardEpis {
  final int total;
  final List<DashboardEpi> lista;

  DashboardEpis({
    required this.total,
    required this.lista,
  });

  factory DashboardEpis.fromJson(
    Map<String, dynamic> json,
  ) {
    return DashboardEpis(
      total: _toInt(json['total']),
      lista: (json['lista'] as List? ?? [])
          .map(
            (epi) => DashboardEpi.fromJson(epi),
          )
          .toList(),
    );
  }
}

class DashboardEpi {
  final dynamic id;
  final String nome;
  final String imagem;
  final String descricao;

  DashboardEpi({
    required this.id,
    required this.nome,
    required this.imagem,
    required this.descricao,
  });

  factory DashboardEpi.fromJson(
    Map<String, dynamic> json,
  ) {
    return DashboardEpi(
      id: json['ID'],
      nome: '${json['NOME_EPI'] ?? ''}',
      imagem: '${json['IMAGEM_EPI'] ?? ''}',
      descricao: '${json['DESCRICAO_EPI'] ?? ''}',
    );
  }
}

// =========================================================
// OCORRÊNCIAS
// =========================================================

class DashboardOcorrencias {
  final int total;
  final int regulares;
  final int irregulares;
  final DashboardOcorrencia? ultimaVerificacao;
  final List<DashboardOcorrencia> historico;

  DashboardOcorrencias({
    required this.total,
    required this.regulares,
    required this.irregulares,
    required this.ultimaVerificacao,
    required this.historico,
  });

  factory DashboardOcorrencias.fromJson(
    Map<String, dynamic> json,
  ) {
    final ultima = json['ultima_verificacao'];

    return DashboardOcorrencias(
      total: _toInt(json['total']),
      regulares: _toInt(json['regulares']),
      irregulares: _toInt(json['irregulares']),
      ultimaVerificacao: ultima is Map
          ? DashboardOcorrencia.fromJson(
              Map<String, dynamic>.from(ultima),
            )
          : null,
      historico: (json['historico'] as List? ?? [])
          .map(
            (ocorrencia) => DashboardOcorrencia.fromJson(
              ocorrencia,
            ),
          )
          .toList(),
    );
  }
}

class DashboardOcorrencia {
  final dynamic id;
  final String dataAnalise;
  final String horaAnalise;
  final String episDetectados;
  final String episAusente;
  final String status;
  final dynamic idCamera;
  final String identificadorCamera;
  final String statusCamera;

  DashboardOcorrencia({
    required this.id,
    required this.dataAnalise,
    required this.horaAnalise,
    required this.episDetectados,
    required this.episAusente,
    required this.status,
    required this.idCamera,
    required this.identificadorCamera,
    required this.statusCamera,
  });

  factory DashboardOcorrencia.fromJson(
    Map<String, dynamic> json,
  ) {
    return DashboardOcorrencia(
      id: json['ID'],
      dataAnalise: '${json['DATA_ANALISE'] ?? ''}',
      horaAnalise: '${json['HORA_ANALISE'] ?? ''}',
      episDetectados: '${json['EPIS_DETECTADOS'] ?? ''}',
      episAusente: '${json['EPIS_AUSENTE'] ?? ''}',
      status: '${json['STATUS_OCORRENCIA'] ?? ''}',
      idCamera: json['FK_ID_CAMERA'],
      identificadorCamera:
          '${json['IDENTIFICADOR_CAMERA'] ?? ''}',
      statusCamera:
          '${json['STATUS_CAMERA'] ?? ''}',
    );
  }
}

// =========================================================
// CÂMERAS
// =========================================================

class DashboardCamera {
  final dynamic id;
  final String identificador;
  final String status;

  DashboardCamera({
    required this.id,
    required this.identificador,
    required this.status,
  });

  factory DashboardCamera.fromJson(
    Map<String, dynamic> json,
  ) {
    return DashboardCamera(
      id: json['ID'],
      identificador:
          '${json['IDENTIFICADOR_CAMERA'] ?? ''}',
      status: '${json['STATUS'] ?? ''}',
    );
  }
}

// =========================================================
// CONVERSÃO SEGURA PARA INT
// =========================================================

int _toInt(dynamic valor) {
  if (valor is int) {
    return valor;
  }

  return int.tryParse(
        valor?.toString() ?? '',
      ) ??
      0;
}