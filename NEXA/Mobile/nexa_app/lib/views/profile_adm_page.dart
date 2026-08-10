import 'package:flutter/material.dart';
import "package:nexa_app/models/user_model.dart";

class PerfiladmPage extends StatefulWidget {
  const PerfiladmPage({super.key});

  @override
  State<PerfiladmPage> createState() => _PerfiladmPageState();
}

class _PerfiladmPageState extends State<PerfiladmPage> {
  bool editando = false;
  bool alterarSenha = false;

  late TextEditingController nomeController;
  late TextEditingController emailController;
  late TextEditingController telefoneController;
  late TextEditingController cpfController;
  late TextEditingController dataController;
  late TextEditingController tipoPerfilController;

  late TextEditingController senhaAtualController;
  late TextEditingController novaSenhaController;
  late TextEditingController confirmarSenhaController;

  String mensagem = "";

  @override
  void initState() {
    super.initState();

    nomeController = TextEditingController(text: admLogado.admnome);
    emailController = TextEditingController(text: admLogado.admemail);
    telefoneController = TextEditingController(text: admLogado.admtelefone);
    cpfController = TextEditingController(text: admLogado.admcpf);
    dataController =
        TextEditingController(text: admLogado.admdataNascimento);
    tipoPerfilController = TextEditingController(text: admLogado.role);

    senhaAtualController = TextEditingController();
    novaSenhaController = TextEditingController();
    confirmarSenhaController = TextEditingController();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),

      //////////////////////////////////////////////////////
      /// APP BAR
      //////////////////////////////////////////////////////
      appBar: AppBar(
        backgroundColor: const Color(0xFF0F2A44),
        foregroundColor: Colors.white,
        title: const Text("Perfil do Administrador"),
      ),

      //////////////////////////////////////////////////////
      /// BODY
      //////////////////////////////////////////////////////
      body: Center(
        child: SingleChildScrollView(
          child: Container(
            width: 500,
            padding: const EdgeInsets.all(25),
            margin: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(20),
              boxShadow: const [
                BoxShadow(
                  color: Colors.black12,
                  blurRadius: 15,
                  offset: Offset(0, 5),
                )
              ],
            ),

            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                /// 🔷 TÍTULO
                const Center(
                  child: Column(
                    children: [
                      Icon(Icons.admin_panel_settings,
                          size: 50, color: Color(0xFF0A66C2)),
                      SizedBox(height: 10),
                      Text(
                        "Perfil do Administrador",
                        style: TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.bold,
                          color: Color(0xFF0F2A44),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 25),

                const Text(
                  "Informações Pessoais",
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0A66C2),
                  ),
                ),

                const SizedBox(height: 15),

                campo("Nome completo", nomeController, icon: Icons.person),
                campo("E-mail corporativo", emailController,
                    icon: Icons.email),
                campo("Telefone", telefoneController, icon: Icons.phone),
                campo("CPF", cpfController,
                    icon: Icons.badge, enabled: false),
                campo("Data de Nascimento", dataController,
                    icon: Icons.calendar_today, enabled: false),

                campo(
                  "Senha",
                  TextEditingController(text: "******"),
                  icon: Icons.lock,
                  oculto: true,
                  enabled: false,
                ),

                const SizedBox(height: 10),

                /// 🔐 ALTERAR SENHA
                OutlinedButton.icon(
                  icon: const Icon(Icons.lock),
                  label: const Text("Alterar senha"),
                  style: OutlinedButton.styleFrom(
                    foregroundColor: Colors.black87,
                    side: BorderSide(color: Colors.grey.shade300),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                  ),
                  onPressed: () {
                    setState(() {
                      alterarSenha = !alterarSenha;
                    });
                  },
                ),

                if (alterarSenha) ...[
                  const SizedBox(height: 10),
                  campo("Senha atual", senhaAtualController,
                      icon: Icons.lock_outline, oculto: true),
                  campo("Nova senha", novaSenhaController,
                      icon: Icons.lock, oculto: true),
                  campo("Confirmar senha", confirmarSenhaController,
                      icon: Icons.lock, oculto: true),
                ],

                if (mensagem.isNotEmpty)
                  Padding(
                    padding: const EdgeInsets.only(top: 10),
                    child: Text(
                      mensagem,
                      style: const TextStyle(
                        color: Colors.red,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                  ),

                const SizedBox(height: 25),

                /// 🔵 BOTÃO
                Center(
                  child: ElevatedButton.icon(
                    icon: const Icon(Icons.edit),
                    label: Text(editando ? "Salvar" : "Editar"),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF0A66C2),
                      foregroundColor: Colors.white,
                      minimumSize: const Size(220, 50),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30),
                      ),
                    ),
                    onPressed: () {
                      setState(() {
                        if (editando) {
                          /// salvar
                          admLogado.admnome = nomeController.text;
                          admLogado.admemail = emailController.text;
                          admLogado.admtelefone =
                              telefoneController.text;

                          if (alterarSenha) {
                            if (senhaAtualController.text !=
                                admLogado.admsenha) {
                              mensagem = "Senha atual incorreta.";
                              return;
                            }

                            if (novaSenhaController.text.isEmpty) {
                              mensagem = "Digite a nova senha.";
                              return;
                            }

                            if (novaSenhaController.text !=
                                confirmarSenhaController.text) {
                              mensagem = "Senhas não coincidem.";
                              return;
                            }

                            admLogado.admsenha =
                                novaSenhaController.text;
                          }

                          mensagem = "";
                          alterarSenha = false;

                          senhaAtualController.clear();
                          novaSenhaController.clear();
                          confirmarSenhaController.clear();
                        }

                        editando = !editando;
                      });
                    },
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// CAMPO PADRÃO
  //////////////////////////////////////////////////////
  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
    bool enabled = true,
    IconData? icon,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextField(
        controller: controller,
        obscureText: oculto,
        enabled: editando && enabled,
        decoration: InputDecoration(
          prefixIcon:
              icon != null ? Icon(icon, color: const Color(0xFF0A66C2)) : null,
          labelText: label,
          filled: true,
          fillColor: const Color(0xFFF1F3F6),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),
        ),
      ),
    );
  }
}