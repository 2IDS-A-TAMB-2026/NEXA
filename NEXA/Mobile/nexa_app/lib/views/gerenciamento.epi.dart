import 'package:flutter/material.dart';

/// ================= MODEL =================
class EPI {
  String nome;
  String descricao; // 🔥 antes era código
  String cpfFuncionario; // 🔥 antes era descrição
  DateTime dataCriacao;

  EPI({
    required this.nome,
    required this.descricao,
    required this.cpfFuncionario,
    required this.dataCriacao,
  });
}

List<EPI> listaEPIs = [];

/// ================= PAGE =================
class CadastroEPIPage extends StatefulWidget {
  const CadastroEPIPage({super.key});

  @override
  State<CadastroEPIPage> createState() => _CadastroEPIPageState();
}

class _CadastroEPIPageState extends State<CadastroEPIPage> {
  final nomeController = TextEditingController();
  final descricaoController = TextEditingController(); // 🔥 novo "codigo"
  final cpfController = TextEditingController(); // 🔥 novo campo

  String mensagem = "";

  void salvar() {
    if (nomeController.text.isEmpty ||
        descricaoController.text.isEmpty ||
        cpfController.text.isEmpty) {
      setState(() {
        mensagem = "Preencha todos os campos";
      });
      return;
    }

    setState(() {
      listaEPIs.add(
        EPI(
          nome: nomeController.text,
          descricao: descricaoController.text,
          cpfFuncionario: cpfController.text,
          dataCriacao: DateTime.now(),
        ),
      );

      nomeController.clear();
      descricaoController.clear();
      cpfController.clear();
      mensagem = "";
    });
  }

  void editar(EPI epi, int index) {
    final nomeEdit = TextEditingController(text: epi.nome);
    final descricaoEdit = TextEditingController(text: epi.descricao);
    final cpfEdit = TextEditingController(text: epi.cpfFuncionario);

    showDialog(
      context: context,
      builder: (_) {
        return AlertDialog(
          title: const Text("Editar EPI"),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(controller: nomeEdit, decoration: const InputDecoration(labelText: "Nome")),
              TextField(controller: descricaoEdit, decoration: const InputDecoration(labelText: "Descrição")),
              TextField(controller: cpfEdit, decoration: const InputDecoration(labelText: "CPF Funcionário")),
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
                  epi.nome = nomeEdit.text;
                  epi.descricao = descricaoEdit.text;
                  epi.cpfFuncionario = cpfEdit.text;
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

                /// 🔷 TÍTULO
                const Center(
                  child: Text(
                    "Cadastro de EPI",
                    style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Color.fromARGB(255, 20, 118, 209),
                    ),
                  ),
                ),

                const SizedBox(height: 25),

                const Text(
                  "Informações do EPI",
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0A66C2),
                  ),
                ),

                const SizedBox(height: 15),

                campo("Nome do EPI", nomeController, Icons.security),
                campo("Descrição", descricaoController, Icons.description), // 🔥 substituiu código
                campo("CPF do Funcionário", cpfController, Icons.badge), // 🔥 novo campo

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
                ...listaEPIs.asMap().entries.map((entry) {
                  int index = entry.key;
                  EPI epi = entry.value;

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
                        const Icon(Icons.security, color: Color(0xFF0A66C2)),
                        const SizedBox(width: 15),

                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                epi.nome,
                                style: const TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),
                              Text("Descrição: ${epi.descricao}"),
                              Text("CPF: ${epi.cpfFuncionario}"),
                              Text(
                                "Criado em: ${epi.dataCriacao.day}/${epi.dataCriacao.month}/${epi.dataCriacao.year}",
                                style: const TextStyle(color: Colors.grey),
                              ),
                            ],
                          ),
                        ),

                        IconButton(
                          icon: const Icon(Icons.edit, color: Colors.blue),
                          onPressed: () => editar(epi, index),
                        ),

                        IconButton(
                          icon: const Icon(Icons.delete, color: Colors.red),
                          onPressed: () {
                            setState(() {
                              listaEPIs.removeAt(index);
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
  Widget campo(String label, TextEditingController controller, IconData icon) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextField(
        controller: controller,
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