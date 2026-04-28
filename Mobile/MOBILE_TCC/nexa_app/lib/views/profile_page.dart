import 'package:flutter/material.dart';
import 'package:nexa_app/main.dart';

class PerfilPage extends StatefulWidget {
  const PerfilPage({super.key});

  @override
  State<PerfilPage> createState() => _PerfilPageState();
}

class _PerfilPageState extends State<PerfilPage> {
  bool editando = false;
  bool alterarSenha = false;

  late TextEditingController nomeController;
  late TextEditingController emailController;
  late TextEditingController telefoneController;
  late TextEditingController cpfController;
  late TextEditingController dataController;
  late TextEditingController tipoPerfilController;
  late TextEditingController uidController;
  late TextEditingController episController;

  late TextEditingController senhaAtualController;
  late TextEditingController novaSenhaController;
  late TextEditingController confirmarSenhaController;

  String mensagem = "";

  @override
  void initState() {
    super.initState();

    nomeController = TextEditingController(text: usuarioLogado.nome);
    emailController = TextEditingController(text: usuarioLogado.email);
    telefoneController = TextEditingController(text: usuarioLogado.telefone);
    cpfController = TextEditingController(text: usuarioLogado.cpf);
    dataController = TextEditingController(text: usuarioLogado.dataNascimento);
    tipoPerfilController = TextEditingController(text: usuarioLogado.tipoPerfil);
    uidController = TextEditingController(text: usuarioLogado.uidRfid);
    episController = TextEditingController(text: usuarioLogado.epis);

    senhaAtualController = TextEditingController();
    novaSenhaController = TextEditingController();
    confirmarSenhaController = TextEditingController();
  }

  @override
  Widget build(BuildContext context) {
    return Center(
      child: SingleChildScrollView(
        child: Container(
          width: 500,
          padding: const EdgeInsets.all(25),
          decoration: BoxDecoration(
            color: Colors.grey[100],
            borderRadius: BorderRadius.circular(12),
            boxShadow: const [
              BoxShadow(color: Colors.black12, blurRadius: 10)
            ],
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [

              const Center(
                child: Text(
                  "Perfil do Usuário",
                  style: TextStyle(
                    fontSize: 26,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0F2A44),
                  ),
                ),
              ),

              const SizedBox(height: 20),

              const Text(
                "Informações Pessoais",
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Color(0xFF0A66C2),
                ),
              ),

              const SizedBox(height: 15),

              campo("Nome completo", nomeController),
              campo("CPF", cpfController),
              campo("Data de nascimento", dataController),
              campo("E-mail corporativo", emailController),
              campo("Telefone", telefoneController),
              campo("Tipo de perfil", tipoPerfilController),
              campo("UID RFID", uidController),
              campo("EPIs obrigatórios", episController),

              campo(
                "Senha",
                TextEditingController(text: "******"),
                oculto: true,
                enabled: false,
              ),

              const SizedBox(height: 10),

              ElevatedButton.icon(
                icon: const Icon(Icons.lock),
                label: const Text("Alterar senha"),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF0A66C2),
                ),
                onPressed: () {
                  setState(() {
                    alterarSenha = !alterarSenha;
                  });
                },
              ),

              if (alterarSenha) ...[
                const SizedBox(height: 10),
                campo("Senha atual", senhaAtualController, oculto: true),
                campo("Nova senha", novaSenhaController, oculto: true),
                campo("Confirmar senha", confirmarSenhaController, oculto: true),
              ],

              if (mensagem.isNotEmpty)
                Padding(
                  padding: const EdgeInsets.only(top: 10),
                  child: Text(
                    mensagem,
                    style: const TextStyle(color: Colors.red),
                  ),
                ),

              const SizedBox(height: 20),

              Center(
                child: ElevatedButton.icon(
                  icon: const Icon(Icons.edit, color: Colors.white),
                  label: Text(
                    editando ? "Salvar" : "Editar",
                    style: const TextStyle(color: Colors.white),
                  ),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF0A66C2),
                    minimumSize: const Size(180, 45),
                  ),
                  onPressed: () {
                    setState(() {

                      if (editando) {
                        usuarioLogado.nome = nomeController.text;
                        usuarioLogado.email = emailController.text;
                        usuarioLogado.telefone = telefoneController.text;

                        if (alterarSenha) {
                          if (senhaAtualController.text != usuarioLogado.senha) {
                            mensagem = "Senha atual incorreta.";
                            return;
                          }

                          if (novaSenhaController.text.isEmpty) {
                            mensagem = "Digite a nova senha.";
                            return;
                          }

                          if (novaSenhaController.text != confirmarSenhaController.text) {
                            mensagem = "Senhas não coincidem.";
                            return;
                          }

                          usuarioLogado.senha = novaSenhaController.text;
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
    );
  }

  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
    bool enabled = true,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextField(
        controller: controller,
        obscureText: oculto,
        enabled: editando && enabled,
        decoration: InputDecoration(
          labelText: label,
          filled: true,
          fillColor: Colors.grey[200],
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(8),
          ),
        ),
      ),
    );
  }
}