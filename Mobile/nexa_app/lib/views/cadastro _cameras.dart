import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';

/// ================= MODEL =================
class CameraModel {
  String nome;
  String setor;
  String cnpj;
  String status;

  CameraModel({
    required this.nome,
    required this.setor,
    required this.cnpj,
    required this.status,
  });
}

List<CameraModel> listaCameras = [];

/// ================= PAGE =================
class CadastroCameraPage extends StatefulWidget {
  const CadastroCameraPage({super.key});

  @override
  State<CadastroCameraPage> createState() => _CadastroCameraPageState();
}

class _CadastroCameraPageState extends State<CadastroCameraPage> {
  final nomeController = TextEditingController();
  final setorController = TextEditingController();
  final cnpjController = TextEditingController();

  String statusSelecionado = "Ativo";
  String mensagem = "";

  /// 🔥 MÁSCARA CNPJ
  final cnpjMask = MaskTextInputFormatter(
    mask: '##.###.###/####-##',
    filter: {"#": RegExp(r'[0-9]')},
  );

  /// 🔥 SALVAR
  void salvar() {
    if (nomeController.text.isEmpty ||
        setorController.text.isEmpty ||
        cnpjController.text.isEmpty) {
      setState(() {
        mensagem = "Preencha todos os campos";
      });
      return;
    }

    setState(() {
      listaCameras.add(
        CameraModel(
          nome: nomeController.text,
          setor: setorController.text,
          cnpj: cnpjController.text,
          status: statusSelecionado,
        ),
      );

      nomeController.clear();
      setorController.clear();
      cnpjController.clear();
      statusSelecionado = "Ativo";
      mensagem = "";
    });
  }

  /// 🔥 EDITAR
  void editar(CameraModel camera, int index) {
    final nomeEdit = TextEditingController(text: camera.nome);
    final setorEdit = TextEditingController(text: camera.setor);
    final cnpjEdit = TextEditingController(text: camera.cnpj);

    String statusEdit = camera.status;

    showDialog(
      context: context,
      builder: (_) {
        return AlertDialog(
          title: const Text("Editar Câmera"),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              TextField(controller: nomeEdit, decoration: const InputDecoration(labelText: "Nome")),
              TextField(controller: setorEdit, decoration: const InputDecoration(labelText: "Setor")),
              TextField(
                controller: cnpjEdit,
                inputFormatters: [cnpjMask],
                keyboardType: TextInputType.number,
                decoration: const InputDecoration(labelText: "CNPJ"),
              ),

              const SizedBox(height: 10),

              DropdownButtonFormField<String>(
                value: statusEdit,
                items: ["Ativo", "Inativo"]
                    .map((s) => DropdownMenuItem(value: s, child: Text(s)))
                    .toList(),
                onChanged: (v) {
                  statusEdit = v!;
                },
                decoration: const InputDecoration(labelText: "Status"),
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
                  camera.nome = nomeEdit.text;
                  camera.setor = setorEdit.text;
                  camera.cnpj = cnpjEdit.text;
                  camera.status = statusEdit;
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

  //////////////////////////////////////////////////////
  /// UI
  //////////////////////////////////////////////////////
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
                    "Cadastro de Câmeras",
                    style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Color.fromARGB(255, 22, 103, 179),
                    ),
                  ),
                ),

                const SizedBox(height: 25),

                const Text(
                  "Informações da Câmera",
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0A66C2),
                  ),
                ),

                const SizedBox(height: 15),

                campo("Nome da câmera", nomeController, Icons.videocam),
                campo("Setor", setorController, Icons.business),

                campo(
                  "CNPJ da empresa",
                  cnpjController,
                  Icons.badge,
                  inputFormatters: [cnpjMask],
                  keyboardType: TextInputType.number,
                ),

                const SizedBox(height: 10),

                /// 🔥 STATUS SELECT
                DropdownButtonFormField<String>(
                  value: statusSelecionado,
                  items: ["Ativo", "Inativo"]
                      .map((s) => DropdownMenuItem(value: s, child: Text(s)))
                      .toList(),
                  onChanged: (v) {
                    setState(() {
                      statusSelecionado = v!;
                    });
                  },
                  decoration: const InputDecoration(
                    labelText: "Status",
                    filled: true,
                    fillColor: Color(0xFFF1F3F6),
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.all(Radius.circular(12)),
                      borderSide: BorderSide.none,
                    ),
                  ),
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
                ...listaCameras.asMap().entries.map((entry) {
                  int index = entry.key;
                  CameraModel camera = entry.value;

                  final bool ativo = camera.status == "Ativo";

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
                        const Icon(Icons.videocam, color: Color(0xFF0A66C2)),
                        const SizedBox(width: 15),

                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                camera.nome,
                                style: const TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),
                              Text("Setor: ${camera.setor}"),
                              Text("CNPJ: ${camera.cnpj}"),

                              /// 🔥 STATUS VISUAL
                              Row(
                                children: [
                                  Container(
                                    width: 8,
                                    height: 8,
                                    decoration: BoxDecoration(
                                      color: ativo ? Colors.green : Colors.red,
                                      shape: BoxShape.circle,
                                    ),
                                  ),
                                  const SizedBox(width: 5),
                                  Text(
                                    camera.status,
                                    style: TextStyle(
                                      color: ativo ? Colors.green : Colors.red,
                                      fontSize: 12,
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ),

                        IconButton(
                          icon: const Icon(Icons.edit, color: Colors.blue),
                          onPressed: () => editar(camera, index),
                        ),

                        IconButton(
                          icon: const Icon(Icons.delete, color: Colors.red),
                          onPressed: () {
                            setState(() {
                              listaCameras.removeAt(index);
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

  //////////////////////////////////////////////////////
  /// CAMPO PADRÃO
  //////////////////////////////////////////////////////
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