import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import "package:nexa_app/models/user_model.dart";
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/dashboard_cameras.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/login_page.dart';
import 'package:provider/provider.dart';

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
    uidController = TextEditingController(text: usuarioLogado.uidRfid);
    episController = TextEditingController(text: usuarioLogado.epis);

    senhaAtualController = TextEditingController();
    novaSenhaController = TextEditingController();
    confirmarSenhaController = TextEditingController();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),

      //////////////////////////////////////////////////////
      /// DRAWER NEXA
      //////////////////////////////////////////////////////
      drawer: Drawer(
        backgroundColor: const Color(0xFF0F2A44),
        child: Column(
          children: [

            /// HEADER
            Container(
              height: 180,
              width: double.infinity,
              child: Stack(
                fit: StackFit.expand,
                children: [
                  Image.asset("assets/funci.webp", fit: BoxFit.cover),

                  Container(
                    decoration: BoxDecoration(
                      gradient: LinearGradient(
                        colors: [
                          Colors.black.withOpacity(0.6),
                          Colors.transparent,
                        ],
                        begin: Alignment.bottomCenter,
                        end: Alignment.topCenter,
                      ),
                    ),
                  ),

                  const Positioned(
                    bottom: 15,
                    left: 15,
                    child: Text(
                      "NEXA",
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            /// MENU
            /// 
            /// 
                
            _menuItem(
              icon: Icons.dashboard,
              texto: "Dashboard",
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (_) => const DashboardPageFun()),
                );
              },
            ),






            _menuItem(
              icon: Icons.camera_alt,
              texto: "Checar EPI",
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (_) => const DashboardCamera()),
                );
              },
            ),

         

            _menuItem(
              icon: Icons.person,
              texto: "Perfil",
              onTap: () {
                Navigator.pop(context);
              },
            ),

            const Spacer(),

            /// SAIR
            _menuItem(
              icon: Icons.logout,
              texto: "Sair",
              onTap: () {
                Navigator.pushAndRemoveUntil(
                  context,
                  MaterialPageRoute(
                    builder: (_) => InstitucionalPage(),
                  ),
                  (route) => false,
                );
              },
            ),

            const SizedBox(height: 10),
          ],
        ),
      ),

      //////////////////////////////////////////////////////
      /// APPBAR
      //////////////////////////////////////////////////////
     appBar: AppBar(
        elevation: 0,
        backgroundColor: const Color(0xFF0F2A44),
         iconTheme: const IconThemeData(
    color: Colors.white, // 🔥 deixa o botão do drawer branco
  ),
        title: const Text("Perfil", style: TextStyle(color: Colors.white)),
        actions: [
          
   

    /// 🔠 AUMENTAR FONTE
    IconButton(
      icon: const Icon(Icons.text_increase,
      size: 25,
        color:   const Color.fromARGB(255, 253, 254, 255),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().aumentarFonte();
      },
    ),

    /// 🔡 DIMINUIR FONTE
    IconButton(
      icon: const Icon(Icons.text_decrease,
      size: 25,
        color:   const Color.fromARGB(255, 253, 254, 255),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().diminuirFonte();
      },
    ),

    IconButton(
  icon: const Icon(Icons.volume_up, color: Colors.white),
  onPressed: () {
    final texto = """
Perfil do Funcionário.

Informações pessoais.
Nome completo, email corporativo, telefone.

Documentos.
CPF e data de nascimento.

Identificação.
UID RFID e EPIs obrigatórios.

Alteração de senha.
Você pode alterar sua senha atual, definir uma nova senha e confirmar a senha.

Para editar o perfil, clique no botão editar perfil.
""";

context.read<AccessibilityController>().lerTexto(texto);  },
),
          
       
        ],
      ),


      //////////////////////////////////////////////////////
      /// BODY (SEU CÓDIGO ORIGINAL)
      //////////////////////////////////////////////////////
      body:

      Stack(
  children: [
    /// 🌄 IMAGEM DE FUNDO
    Positioned.fill(
      child: Image.asset(
        "assets/fundo.jpg", // 👈 sua imagem aqui
        fit: BoxFit.cover,
      ),
    ),

    /// 🌫️ OVERLAY (escurecer fundo)
    Positioned.fill(
      child: Container(
        color: const Color.fromARGB(255, 78, 137, 247).withOpacity(0.4),
      ),
    ),
      
      
      
       Center(
        child: SingleChildScrollView(
          child: Container(
            width: 500,
            padding: const EdgeInsets.all(28),
            margin: const EdgeInsets.symmetric(vertical: 20),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(22),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.06),
                  blurRadius: 18,
                  offset: const Offset(0, 8),
                )
              ],
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [

                const Center(
                  child: Column(
                    children: [
                      Icon(Icons.person, size: 50, color: Color(0xFF0A66C2)),
                      SizedBox(height: 10),
                      Text(
                        "Perfil do Funcionário",
                        style: TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.bold,
                          color: Color.fromARGB(255, 18, 106, 189),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 30),

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
                campo("E-mail corporativo", emailController, icon: Icons.email),
                campo("Telefone", telefoneController, icon: Icons.phone),

                campo("CPF", cpfController, icon: Icons.badge, enabled: false),
                campo("Data de nascimento", dataController, icon: Icons.calendar_today, enabled: false),

                campo("UID RFID", uidController, icon: Icons.nfc, enabled: false),
                campo("EPIs obrigatórios", episController, icon: Icons.security, enabled: false),
const SizedBox(height: 20),

OutlinedButton.icon(
  icon: const Icon(Icons.lock),
  label: const Text("Alterar senha"),
  style: OutlinedButton.styleFrom(
    foregroundColor: const Color.fromARGB(221, 54, 89, 204),
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
  const SizedBox(height: 15),

  campo(
    "Senha atual",
    senhaAtualController,
    icon: Icons.lock_outline,
    oculto: true,
  ),

  campo(
    "Nova senha",
    novaSenhaController,
    icon: Icons.lock,
    oculto: true,
  ),

  campo(
    "Confirmar senha",
    confirmarSenhaController,
    icon: Icons.lock,
    oculto: true,
  ),
],
                const SizedBox(height: 30),

                Center(
                  child: ElevatedButton.icon(
                    icon: const Icon(Icons.edit),
                    label: Text(editando ? "Salvar alterações" : "Editar perfil"),
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

      /// 🔐 VALIDAÇÃO DE SENHA
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

      /// salvar dados
      usuarioLogado.nome = nomeController.text;
      usuarioLogado.email = emailController.text;
      usuarioLogado.telefone = telefoneController.text;

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
  ],
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// MENU ITEM
  //////////////////////////////////////////////////////
  Widget _menuItem({
    required IconData icon,
    required String texto,
    required VoidCallback onTap,
  }) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 6),
      child: InkWell(
        borderRadius: BorderRadius.circular(12),
        onTap: onTap,
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 14, horizontal: 12),
          child: Row(
            children: [
              Icon(icon, color: Colors.white70),
              const SizedBox(width: 15),
              Text(
                texto,
                style: const TextStyle(
                  color: Colors.white,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// CAMPO
  //////////////////////////////////////////////////////
  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
    bool enabled = true,
    IconData? icon,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 14),
      child: TextField(
        controller: controller,
        obscureText: oculto,
        enabled: editando && enabled,
        decoration: InputDecoration(
          prefixIcon: icon != null
              ? Icon(icon, color: const Color(0xFF0A66C2))
              : null,
          labelText: label,
          filled: true,
          fillColor: const Color(0xFFF1F3F6),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: BorderSide.none,
          ),
        ),
      ),
    );
  }
}