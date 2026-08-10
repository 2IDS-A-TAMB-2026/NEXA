import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';

/// ================= MODEL =================
class Setor {
  String nome;
  String localizacao;
  String cnpj;

  Setor({
    required this.nome,
    required this.localizacao,
    required this.cnpj,
  });
}

List<Setor> listaSetores = [];

/// ================= PAGE =================
class CadastroSetorPage extends StatefulWidget {
  const CadastroSetorPage({super.key});

  @override
  State<CadastroSetorPage> createState() => _CadastroSetorPageState();
}

class _CadastroSetorPageState extends State<CadastroSetorPage> {
  final nomeController = TextEditingController();
  final localController = TextEditingController();
  final cnpjController = TextEditingController();

  String mensagem = "";

  /// 🔥 MÁSCARA CNPJ
  final cnpjMask = MaskTextInputFormatter(
    mask: '##.###.###/####-##',
    filter: {"#": RegExp(r'[0-9]')},
  );

  /// 🔥 SALVAR
  void salvar() {
    if (nomeController.text.isEmpty ||
        localController.text.isEmpty ||
        cnpjController.text.isEmpty) {
      setState(() {
        mensagem = "Preencha todos os campos";
      });
      return;
    }

    setState(() {
      listaSetores.add(
        Setor(
          nome: nomeController.text,
          localizacao: localController.text,
          cnpj: cnpjController.text,
        ),
      );

      nomeController.clear();
      localController.clear();
      cnpjController.clear();
      mensagem = "";
    });
  }

  /// 🔥 EDITAR
  void editar(Setor setor, int index) {
    final nomeEdit = TextEditingController(text: setor.nome);
    final localEdit = TextEditingController(text: setor.localizacao);
    final cnpjEdit = TextEditingController(text: setor.cnpj);

    showDialog(
      context: context,
      builder: (_) {
        return AlertDialog(
          title: const Text("Editar Setor"),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(controller: nomeEdit, decoration: const InputDecoration(labelText: "Nome")),
              TextField(controller: localEdit, decoration: const InputDecoration(labelText: "Localização")),
              TextField(
                controller: cnpjEdit,
                inputFormatters: [cnpjMask],
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: "CNPJ"),
              ),
            ],
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text("Cancelar"),
            ),
            ElevatedButton(
              onPressed: () {
                setState(() {
                  setor.nome = nomeEdit.text;
                  setor.localizacao = localEdit.text;
                  setor.cnpj = cnpjEdit.text;
                });
                Navigator.pop(context);
              },
              child: const Text("Salvar"),
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.transparent, // 🔥 remove fundo branco externo

      body: Center(
        child: SingleChildScrollView(
          child: Container(
            width: 500,
            padding: const EdgeInsets.all(25),

            decoration: BoxDecoration(
              color: Colors.white, // 🔥 mantém só o card branco
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

                /// 🔥 TÍTULO
                const Center(
                  child: Text(
                    "Cadastro de Setor",
                    style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Color.fromARGB(255, 22, 102, 177),
                    ),
                  ),
                ),

                const SizedBox(height: 25),

                const Text(
                  "Informações do Setor",
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0A66C2),
                  ),
                ),

                const SizedBox(height: 15),

                campo("Nome do setor", nomeController, Icons.business),
                campo("Localização", localController, Icons.location_on),

                /// 🔥 CNPJ COM MÁSCARA
                campo(
                  "CNPJ da empresa",
                  cnpjController,
                  Icons.badge,
                  inputFormatters: [cnpjMask],
                  keyboardType: TextInputType.number,
                ),

                if (mensagem.isNotEmpty)
                  Padding(
                    padding: const EdgeInsets.only(top: 10),
                    child: Text(
                      mensagem,
                      style: const TextStyle(color: Colors.red),
                    ),
                  ),

                const SizedBox(height: 20),

                /// BOTÃO
                Center(
                  child: ElevatedButton.icon(
                    onPressed: salvar,
                    icon: const Icon(Icons.add, color: Colors.white),
                    label: const Text(
                      "Cadastrar",
                      style: TextStyle(color: Colors.white),
                    ),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF0A66C2),
                      minimumSize: const Size(200, 50),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(25),
                      ),
                    ),
                  ),
                ),

                const SizedBox(height: 30),

                /// 🔥 LISTA
                ...listaSetores.asMap().entries.map((entry) {
                  int index = entry.key;
                  Setor setor = entry.value;

                  return Container(
                    margin: const EdgeInsets.only(bottom: 15),
                    padding: const EdgeInsets.all(18),

                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: const [
                        BoxShadow(color: Colors.black12, blurRadius: 8)
                      ],
                      border: Border.all(color: Colors.grey.shade200),
                    ),

                    child: Row(
                      children: [
                        const Icon(Icons.business, color: Color(0xFF0A66C2)),
                        const SizedBox(width: 15),

                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                setor.nome,
                                style: const TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),
                              Text("Local: ${setor.localizacao}"),
                              Text("CNPJ: ${setor.cnpj}"),
                            ],
                          ),
                        ),

                        IconButton(
                          icon: const Icon(Icons.edit, color: Colors.blue),
                          onPressed: () => editar(setor, index),
                        ),

                        IconButton(
                          icon: const Icon(Icons.delete, color: Colors.red),
                          onPressed: () {
                            setState(() {
                              listaSetores.removeAt(index);
                            });
                          },
                        ),
                      ],
                    ),
                  );
                }).toList(),
              ],
            ),
          ),
        ),
      ),
    );
  }

  /// 🔧 CAMPO PADRÃO
  Widget campo(
    String label,
    TextEditingController controller,
    IconData icon, {
    List<TextInputFormatter>? inputFormatters,
    TextInputType? keyboardType,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextField(
        controller: controller,
        inputFormatters: inputFormatters,
        keyboardType: keyboardType,
        decoration: InputDecoration(
          prefixIcon: Icon(icon, color: const Color(0xFF0A66C2)),
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