import 'dart:convert';

import 'package:camera/camera.dart';
import 'package:flutter/material.dart';

import '../controllers/camera_controller.dart';
import '../models/camera_model.dart';
import '../models/user_model.dart';
import '../services/api_service.dart';

class DashboardCameraPage extends StatefulWidget {
  const DashboardCameraPage({super.key});

  @override
  State<DashboardCameraPage> createState() => _DashboardCameraState();
}

class _DashboardCameraState extends State<DashboardCameraPage> {
  final CameraControllerApp _cameraController =
      CameraControllerApp();

  List<CameraModel> _cameras = [];

  CameraModel? _cameraSelecionada;

  bool _carregandoCameras = true;
  bool _analisando = false;

  String? _erro;

  Map<String, dynamic>? _resultado;

  @override
  void initState() {
    super.initState();

    _carregarCameras();
    _inicializarCamera();
  }

  // =========================================================
  // CÂMERA DO CELULAR
  // =========================================================

  Future<void> _inicializarCamera() async {
    await _cameraController.inicializar();

    if (mounted) {
      setState(() {});
    }
  }

  // =========================================================
  // CÂMERAS DO SETOR
  // =========================================================

  Future<void> _carregarCameras() async {
    try {
      final idSetor = int.tryParse(
        usuarioLogado.idSetor,
      );

      if (idSetor == null) {
        throw Exception(
          'O funcionário não possui um setor válido.',
        );
      }

      final cameras =
          await ApiService.buscarCamerasDoSetor(
        idSetor,
      );

      if (!mounted) return;

      setState(() {
        _cameras = cameras;
        _carregandoCameras = false;

        if (_cameras.isNotEmpty) {
          _cameraSelecionada = _cameras.first;
        }
      });
    } catch (e) {
      if (!mounted) return;

      setState(() {
        _carregandoCameras = false;

        _erro = e
            .toString()
            .replaceFirst('Exception: ', '');
      });
    }
  }

  // =========================================================
  // ANALISAR EPI
  // =========================================================
Future<void> _analisarEpi() async {
  if (_cameraSelecionada == null) {
    _mostrarMensagem(
      'Selecione uma câmera.',
    );
    return;
  }

  if (_analisando) return;

  try {
    setState(() {
      _analisando = true;
      _resultado = null;
    });

    final XFile? foto =
        await _cameraController.tirarFoto();

    if (foto == null) {
      throw Exception(
        'Não foi possível capturar a imagem.',
      );
    }

    // =====================================================
    // PEGA OS BYTES DIRETAMENTE DO XFILE
    // FUNCIONA NO CELULAR E NO NAVEGADOR
    // =====================================================

    final bytes = await foto.readAsBytes();

    final imagemBase64 = base64Encode(bytes);

    // =====================================================
    // ENVIA PARA A API
    // =====================================================

    final resultado =
        await ApiService.analisarEpi(
      cameraId: _cameraSelecionada!.id,
      cpf: usuarioLogado.cpf,
      imagemBase64: imagemBase64,
    );

    if (!mounted) return;

    setState(() {
      _resultado = resultado;
      _analisando = false;
    });

    _mostrarResultado(resultado);
  } catch (e) {
    if (!mounted) return;

    setState(() {
      _analisando = false;
    });

    _mostrarMensagem(
      e.toString().replaceFirst(
        'Exception: ',
        '',
      ),
    );
  }
}
  // =========================================================
  // MENSAGEM
  // =========================================================

  void _mostrarMensagem(String mensagem) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(mensagem),
        backgroundColor: const Color(
          0xFF0F2A44,
        ),
      ),
    );
  }

  // =========================================================
  // RESULTADO
  // =========================================================

  void _mostrarResultado(
    Map<String, dynamic> resultado,
  ) {
    final status =
        resultado['status_ocorrencia']
            ?.toString() ??
            '';

    final conforme =
        status.toLowerCase() == 'conforme';

    final ausentes =
        (resultado['epis_ausentes'] as List?)
                ?.map(
                  (e) => e.toString(),
                )
                .toList() ??
            [];

    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (context) {
        return Container(
          padding: const EdgeInsets.fromLTRB(
            22,
            12,
            22,
            30,
          ),
          decoration: const BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.vertical(
              top: Radius.circular(28),
            ),
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment:
                CrossAxisAlignment.start,
            children: [

              Center(
                child: Container(
                  width: 45,
                  height: 5,
                  decoration: BoxDecoration(
                    color: Colors.grey.shade300,
                    borderRadius:
                        BorderRadius.circular(10),
                  ),
                ),
              ),

              const SizedBox(height: 20),

              Row(
                children: [
                  Icon(
                    conforme
                        ? Icons.check_circle
                        : Icons.warning_rounded,
                    color: conforme
                        ? Colors.green
                        : Colors.red,
                    size: 38,
                  ),

                  const SizedBox(width: 12),

                  Text(
                    conforme
                        ? 'CONFORME'
                        : 'IRREGULAR',
                    style: TextStyle(
                      fontSize: 25,
                      fontWeight: FontWeight.bold,
                      color: conforme
                          ? Colors.green.shade700
                          : Colors.red.shade700,
                    ),
                  ),
                ],
              ),

              const SizedBox(height: 20),

              if (conforme)
                const Row(
                  children: [
                    Icon(
                      Icons.verified,
                      color: Colors.green,
                    ),
                    SizedBox(width: 8),
                    Expanded(
                      child: Text(
                        'Todos os EPIs obrigatórios foram identificados.',
                        style: TextStyle(
                          fontSize: 16,
                        ),
                      ),
                    ),
                  ],
                ),

              if (ausentes.isNotEmpty) ...[
                const Text(
                  'EPIs ausentes:',
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    fontSize: 17,
                  ),
                ),

                const SizedBox(height: 10),

                ...ausentes.map(
                  (epi) => Padding(
                    padding:
                        const EdgeInsets.only(
                      bottom: 7,
                    ),
                    child: Row(
                      children: [
                        const Icon(
                          Icons.close,
                          color: Colors.red,
                        ),
                        const SizedBox(width: 8),
                        Text(
                          epi,
                          style: const TextStyle(
                            fontSize: 15,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ],

              const SizedBox(height: 18),

              SizedBox(
                width: double.infinity,
                height: 50,
                child: ElevatedButton(
                  onPressed: () =>
                      Navigator.pop(context),
                  style:
                      ElevatedButton.styleFrom(
                    backgroundColor:
                        const Color(0xFF0A66C2),
                    foregroundColor: Colors.white,
                    shape:
                        RoundedRectangleBorder(
                      borderRadius:
                          BorderRadius.circular(12),
                    ),
                  ),
                  child: const Text(
                    'FECHAR',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  // =========================================================
  // SELETOR DE CÂMERA
  // =========================================================

  Widget _cameraSelector() {
    if (_carregandoCameras) {
      return Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 16,
          vertical: 12,
        ),
        decoration: BoxDecoration(
          color: Colors.black.withOpacity(0.65),
          borderRadius:
              BorderRadius.circular(14),
        ),
        child: const Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            SizedBox(
              width: 18,
              height: 18,
              child:
                  CircularProgressIndicator(
                strokeWidth: 2,
                color: Colors.white,
              ),
            ),
            SizedBox(width: 10),
            Text(
              'Carregando câmeras...',
              style: TextStyle(
                color: Colors.white,
              ),
            ),
          ],
        ),
      );
    }

    if (_erro != null) {
      return Container(
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: Colors.red.withOpacity(0.8),
          borderRadius:
              BorderRadius.circular(14),
        ),
        child: Text(
          _erro!,
          style: const TextStyle(
            color: Colors.white,
          ),
        ),
      );
    }

    if (_cameras.isEmpty) {
      return Container(
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: Colors.black.withOpacity(0.7),
          borderRadius:
              BorderRadius.circular(14),
        ),
        child: const Text(
          'Nenhuma câmera disponível neste setor.',
          style: TextStyle(
            color: Colors.white,
          ),
        ),
      );
    }

    return Container(
      padding: const EdgeInsets.symmetric(
        horizontal: 14,
      ),
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(0.65),
        borderRadius:
            BorderRadius.circular(14),
      ),
      child: DropdownButtonHideUnderline(
        child: DropdownButton<CameraModel>(
          value: _cameraSelecionada,

          dropdownColor:
              const Color(0xFF0F2A44),

          icon: const Icon(
            Icons.keyboard_arrow_down,
            color: Colors.white,
          ),

          style: const TextStyle(
            color: Colors.white,
            fontSize: 15,
          ),

          items: _cameras.map(
            (camera) {
              return DropdownMenuItem<
                  CameraModel>(
                value: camera,
                child: Row(
                  children: [
                    const Icon(
                      Icons.videocam,
                      color: Colors.white,
                      size: 20,
                    ),
                    const SizedBox(width: 8),
                    Text(
                      camera.identificador,
                    ),
                  ],
                ),
              );
            },
          ).toList(),

          onChanged: (camera) {
            setState(() {
              _cameraSelecionada = camera;
              _resultado = null;
            });
          },
        ),
      ),
    );
  }

  // =========================================================
  // BOTÃO ANALISAR
  // =========================================================

  Widget _botaoAnalise() {
    return GestureDetector(
      onTap: _analisando
          ? null
          : _analisarEpi,
      child: Container(
        width: 68,
        height: 68,
        decoration: BoxDecoration(
          shape: BoxShape.circle,
          color: const Color(0xFF0A66C2),
          border: Border.all(
            color: Colors.white,
            width: 4,
          ),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(
                0.35,
              ),
              blurRadius: 12,
              offset: const Offset(0, 4),
            ),
          ],
        ),
        child: _analisando
            ? const Padding(
                padding: EdgeInsets.all(20),
                child:
                    CircularProgressIndicator(
                  strokeWidth: 3,
                  color: Colors.white,
                ),
              )
            : const Icon(
                Icons.document_scanner,
                color: Colors.white,
                size: 30,
              ),
      ),
    );
  }

  // =========================================================
  // BUILD
  // =========================================================

  @override
  Widget build(BuildContext context) {
    final controller =
        _cameraController.controller;

    return Scaffold(
      backgroundColor: Colors.black,

      // =====================================================
      // NAVBAR
      // =====================================================

      appBar: AppBar(
        backgroundColor:
            const Color(0xFF0A66C2),
        foregroundColor: Colors.white,
        elevation: 0,

        title: const Text(
          'Análise de EPI',
          style: TextStyle(
            fontWeight: FontWeight.bold,
          ),
        ),
      ),

      // =====================================================
      // CÂMERA OCUPANDO TODO O RESTANTE
      // =====================================================

      body: Stack(
        fit: StackFit.expand,
        children: [

          // -------------------------------------------------
          // PREVIEW
          // -------------------------------------------------

          if (_cameraController.inicializando)
            const Center(
              child: CircularProgressIndicator(
                color: Colors.white,
              ),
            )
          else if (_cameraController.erro !=
              null)
            Center(
              child: Padding(
                padding: const EdgeInsets.all(25),
                child: Text(
                  _cameraController.erro!,
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 16,
                  ),
                  textAlign: TextAlign.center,
                ),
              ),
            )
          else if (controller != null &&
              controller.value.isInitialized)
            SizedBox.expand(
              child: CameraPreview(
                controller,
              ),
            )
          else
            const Center(
              child: Text(
                'Câmera indisponível',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 16,
                ),
              ),
            ),

          // -------------------------------------------------
          // DEGRADÊ INFERIOR
          // -------------------------------------------------

          Positioned(
            left: 0,
            right: 0,
            bottom: 0,
            height: 190,
            child: IgnorePointer(
              child: DecoratedBox(
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.transparent,
                      Colors.black.withOpacity(
                        0.75,
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),

          // -------------------------------------------------
          // SETOR / CÂMERA
          // -------------------------------------------------

          Positioned(
            left: 16,
            right: 16,
            bottom: 110,
            child: Row(
              mainAxisAlignment:
                  MainAxisAlignment.center,
              children: [
                _cameraSelector(),
              ],
            ),
          ),

          // -------------------------------------------------
          // BOTÃO ANALISAR
          // -------------------------------------------------

          Positioned(
            left: 0,
            right: 0,
            bottom: 25,
            child: Row(
              mainAxisAlignment:
                  MainAxisAlignment.center,
              children: [
                _botaoAnalise(),
              ],
            ),
          ),
        ],
      ),
    );
  }

  @override
  void dispose() {
    _cameraController.dispose();
    super.dispose();
  }
}