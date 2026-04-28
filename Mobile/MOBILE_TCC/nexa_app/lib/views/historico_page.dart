 import 'package:flutter/material.dart';
 
class OcorrenciaPage extends StatefulWidget {
  const OcorrenciaPage({super.key});

  @override
  State<OcorrenciaPage> createState() => _OcorrenciaPageState();
}

class _OcorrenciaPageState extends State<OcorrenciaPage> {
  bool editando = false;

  late TextEditingController dataController;
  late TextEditingController localController;
  late TextEditingController EPIdetectadoController;
  late TextEditingController EPIausenteController;
  late TextEditingController StatusOcorrenciaController;

  String mensagem = "";



@override
Widget build(BuildContext context) {
  return Scaffold( // Adicione um Scaffold para estrutura básica
    appBar: AppBar(title: Text("Ocorrências")),
    body: ListView(
      children: [
        ocorrenciaCard("VIOLAÇÃO", "EPI não detectado: Luvas", "Carlos Silva • Zona A", Colors.red),
        ocorrenciaCard("CONFORME", "Todos EPIs corretos", "Ana Oliveira • Zona B", Colors.green),
       
      ],
    ),
  );
}
 

  Widget ocorrenciaCard(
      String tipo,
      String titulo,
      String info,
      Color cor) {
    return Card(
      margin: const EdgeInsets.only(
          bottom: 15),
      child: Padding(
        padding:
            const EdgeInsets.all(15),
        child: Column(
          crossAxisAlignment:
              CrossAxisAlignment
                  .start,
          children: [
            Text(tipo,
                style: TextStyle(
                    color: cor,
                    fontWeight:
                        FontWeight
                            .bold)),
            const SizedBox(height: 8),
            Text(titulo,
                style: const TextStyle(
                    fontSize: 16,
                    fontWeight:
                        FontWeight
                            .bold)),
            const SizedBox(height: 6),
            Text(info),
          ],
        ),
      ),
    );
  }
}