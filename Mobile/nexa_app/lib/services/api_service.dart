import 'dart:convert';
import 'package:http/http.dart' as http;

import '../models/dashboard_fun_model.dart';
import '../models/user_model.dart';

class ApiService {

  // =========================================================
  // URL BASE DA API
  // =========================================================

  static const String baseUrl =
     'http://10.141.130.97/nexa/public';


  // =========================================================
  // LOGIN DO FUNCIONÁRIO
  // =========================================================
// =========================================================
// LOGIN DO FUNCIONÁRIO
// =========================================================

static Future<UserModel> login(
  String email,
  String senha,
) async {
  final url = Uri.parse(
    '$baseUrl/api/login',
  );

  final resposta = await http.post(
    url,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: jsonEncode({
      'email': email,
      'senha': senha,
    }),
  );

  Map<String, dynamic> dados;

  try {
    dados = jsonDecode(resposta.body);
  } catch (_) {
    throw Exception(
      'A API retornou uma resposta inválida.',
    );
  }

  if (resposta.statusCode != 200) {
    throw Exception(
      dados['message'] ??
          'Erro ao realizar login. '
          'Status: ${resposta.statusCode}',
    );
  }

  if (dados['status'] != 200) {
    throw Exception(
      dados['message'] ??
          'E-mail ou senha inválidos.',
    );
  }

  // =======================================================
  // GARANTIR QUE O LOGIN É DE FUNCIONÁRIO
  // =======================================================

  if (dados['tipo'] != 'FUNCIONARIO') {
    throw Exception(
      'Acesso permitido somente para funcionários.',
    );
  }

  final usuarioJson = dados['usuario'];

  if (usuarioJson == null ||
      usuarioJson is! Map) {
    throw Exception(
      'A API não retornou os dados do funcionário.',
    );
  }

  final usuario = UserModel.fromJson(
    Map<String, dynamic>.from(
      usuarioJson,
    ),
  );

  // =======================================================
  // GARANTIR CPF
  // =======================================================

  if (usuario.cpf.isEmpty) {
    throw Exception(
      'A API não retornou o CPF do funcionário.',
    );
  }

  return usuario;
}

  // =========================================================
  // DASHBOARD DO FUNCIONÁRIO
  // =========================================================

  static Future<DashboardFunModel>
      buscarDashboardFuncionario(
    String cpf,
  ) async {

  final url = Uri.parse(
  '$baseUrl/api/dashboard/$cpf',
);
    final resposta = await http.get(
      url,
      headers: {
        'Accept': 'application/json',
      },
    );

    if (resposta.statusCode != 200) {
      throw Exception(
        'Erro ao carregar dashboard. '
        'Status: ${resposta.statusCode}',
      );
    }

    final Map<String, dynamic> dados =
        jsonDecode(resposta.body);

    if (dados['status'] != 200) {
      throw Exception(
        dados['message'] ??
            'Não foi possível carregar o dashboard.',
      );
    }

    return DashboardFunModel.fromJson(
      dados,
    );
  }

  // =========================================================
// BUSCAR PERFIL DO FUNCIONÁRIO
// =========================================================

static Future<UserModel> buscarPerfilFuncionario(
  String cpf,
) async {
  final url = Uri.parse(
    '$baseUrl/api/perfil/$cpf',
  );

  final resposta = await http.get(
    url,
    headers: {
      'Accept': 'application/json',
    },
  );

  Map<String, dynamic> dados;

  try {
    dados = jsonDecode(resposta.body);
  } catch (_) {
    throw Exception(
      'A API retornou uma resposta inválida.',
    );
  }

  if (resposta.statusCode != 200 ||
      dados['status'] != 200) {
    throw Exception(
      dados['message'] ??
          'Não foi possível carregar o perfil.',
    );
  }

  final perfilJson = dados['data'];

  if (perfilJson == null ||
      perfilJson is! Map) {
    throw Exception(
      'A API não retornou os dados do perfil.',
    );
  }

  return UserModel.fromJson(
    Map<String, dynamic>.from(perfilJson),
  );
}


// =========================================================
// ATUALIZAR PERFIL
// =========================================================

static Future<void> atualizarPerfil(
  String cpf, {
  required String nome,
  required String email,
  required String telefone,
}) async {
  final url = Uri.parse(
    '$baseUrl/api/perfil/$cpf',
  );

  final resposta = await http.put(
    url,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: jsonEncode({
      'nome': nome,
      'email': email,
      'telefone': telefone,
    }),
  );

  Map<String, dynamic> dados;

  try {
    dados = jsonDecode(resposta.body);
  } catch (_) {
    throw Exception(
      'A API retornou uma resposta inválida.',
    );
  }

  if (resposta.statusCode != 200 ||
      dados['status'] != 200) {
    throw Exception(
      dados['message'] ??
          'Não foi possível atualizar o perfil.',
    );
  }
}


// =========================================================
// ALTERAR SENHA
// =========================================================

static Future<void> alterarSenha(
  String cpf, {
  required String senhaAtual,
  required String novaSenha,
}) async {
  // =======================================================
  // NOVA SENHA VAZIA = NÃO ALTERAR
  // =======================================================

  if (novaSenha.trim().isEmpty) {
    return;
  }

  final url = Uri.parse(
    '$baseUrl/api/perfil/$cpf/senha',
  );

  final resposta = await http.put(
    url,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: jsonEncode({
      'senhaAtual': senhaAtual,
      'novaSenha': novaSenha,
    }),
  );

  Map<String, dynamic> dados;

  try {
    dados = jsonDecode(resposta.body);
  } catch (_) {
    throw Exception(
      'A API retornou uma resposta inválida.',
    );
  }

  if (resposta.statusCode != 200 ||
      dados['status'] != 200) {
    throw Exception(
      dados['message'] ??
          'Não foi possível alterar a senha.',
    );
  }
}
}


