import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/models/dashboard_fun_model.dart';
import 'package:nexa_app/models/user_model.dart';
import 'package:nexa_app/services/api_service.dart';
import 'package:nexa_app/views/dashboard_cameras.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/profile_page.dart';
import 'package:provider/provider.dart';

class DashboardPageFun extends StatefulWidget {
  const DashboardPageFun({super.key});

  @override
  State<DashboardPageFun> createState() =>
      _DashboardPageFunState();
}

class _DashboardPageFunState extends State<DashboardPageFun> {
  DashboardFunModel? dashboard;

  bool carregando = true;
  String? erro;

  @override
  void initState() {
    super.initState();
    carregarDashboard();
  }

  // =========================================================
  // CARREGAR DASHBOARD PELA API
  // =========================================================

  Future<void> carregarDashboard() async {
    if (!mounted) return;

    setState(() {
      carregando = true;
      erro = null;
    });

    try {
      final dados =
          await ApiService.buscarDashboardFuncionario(
        usuarioLogado.cpf,
      );

      if (!mounted) return;

      setState(() {
        dashboard = dados;
        carregando = false;
      });
    } catch (e) {
      if (!mounted) return;

      setState(() {
        carregando = false;
        erro = e
            .toString()
            .replaceFirst('Exception: ', '');
      });
    }
  }

  // =========================================================
  // DARK MODE
  // =========================================================

  bool verificarDarkMode(
    AccessibilityController accessibility,
  ) {
    try {
      return (accessibility as dynamic).darkMode ??
          (accessibility as dynamic).isDarkMode ??
          false;
    } catch (_) {
      return false;
    }
  }

  // =========================================================
  // BUILD
  // =========================================================

  @override
  Widget build(BuildContext context) {
    final accessibility =
        context.watch<AccessibilityController>();

        

    final bool isDarkMode =
        verificarDarkMode(accessibility);

    final Color backgroundColor = isDarkMode
        ? const Color(0xFF000000)
        : const Color(0xFFF3F5F9);

    final Color appBarColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    final Color subTextColor = isDarkMode
        ? Colors.white70
        : Colors.grey;

    final String nome =
        dashboard?.funcionario.nome.isNotEmpty == true
            ? dashboard!.funcionario.nome
            : usuarioLogado.nome.isNotEmpty
                ? usuarioLogado.nome
                : "Funcionário";

    final String empresa =
        dashboard?.funcionario.empresa.isNotEmpty == true
            ? dashboard!.funcionario.empresa
            : usuarioLogado.empresa.isNotEmpty
                ? usuarioLogado.empresa
                : "NEXA SOLUÇÕES";

    return Scaffold(
      backgroundColor: backgroundColor,

      // =====================================================
      // DRAWER
      // =====================================================

      drawer: _buildDrawer(context),

      // =====================================================
      // APP BAR
      // =====================================================

      appBar: AppBar(
        elevation: 0,
        backgroundColor: appBarColor,
        iconTheme: const IconThemeData(
          color: Color(0xFF0F62FE),
        ),

        title: Row(
          children: [
            Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              children: [
                Text(
                  "Bem-vindo,",
                  style: TextStyle(
                    color: isDarkMode
                        ? Colors.white
                        : const Color(0xFF0F62FE),
                    fontSize: 22,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(
                  nome,
                  style: TextStyle(
                    color: subTextColor,
                    fontSize: 13,
                    fontWeight: FontWeight.w400,
                  ),
                ),
              ],
            ),
          ],
        ),

    actions: [
  // =================================================
  // ACESSIBILIDADE
  // =================================================
  PopupMenuButton<String>(
    icon: const Icon(
      Icons.settings_outlined,
      color: Color(0xFF0F62FE),
    ),
    tooltip: "Acessibilidade",
    onSelected: (value) {
      final accessibility =
          context.read<AccessibilityController>();

      switch (value) {
        case 'aumentar':
          accessibility.aumentarFonte();
          break;

        case 'diminuir':
          accessibility.diminuirFonte();
          break;

        case 'escuro':
          try {
            (accessibility as dynamic).toggleDarkMode();
          } catch (_) {
            try {
              (accessibility as dynamic).alternarTema();
            } catch (_) {}
          }
          break;

        case 'contraste':
          try {
            (accessibility as dynamic).toggleHighContrast();
          } catch (_) {
            try {
              (accessibility as dynamic).alternarAltoContraste();
            } catch (_) {}
          }
          break;

        case 'ler':
          final texto = """
          Bem-vindo $nome.
          Empresa $empresa.
          Dashboard do funcionário.
          Total de EPIs: ${dashboard?.epis.total ?? 0}.
          Total de ocorrências: ${dashboard?.ocorrencias.total ?? 0}.
          Ocorrências regulares: ${dashboard?.ocorrencias.regulares ?? 0}.
          Ocorrências irregulares: ${dashboard?.ocorrencias.irregulares ?? 0}.
          """;

          accessibility.lerTexto(texto);
          break;
      }
    },
    itemBuilder: (context) => [
      const PopupMenuItem<String>(
        enabled: false,
        child: Text(
          "Acessibilidade",
          style: TextStyle(
            fontWeight: FontWeight.bold,
            color: Color(0xFF0F62FE),
          ),
        ),
      ),

      const PopupMenuDivider(),

      const PopupMenuItem<String>(
        value: 'aumentar',
        child: Row(
          children: [
            Icon(
              Icons.text_increase,
              color: Color(0xFF0F62FE),
            ),
            SizedBox(width: 12),
            Text("Aumentar fonte"),
          ],
        ),
      ),

      const PopupMenuItem<String>(
        value: 'diminuir',
        child: Row(
          children: [
            Icon(
              Icons.text_decrease,
              color: Color(0xFF0F62FE),
            ),
            SizedBox(width: 12),
            Text("Diminuir fonte"),
          ],
        ),
      ),

      const PopupMenuItem<String>(
        value: 'escuro',
        child: Row(
          children: [
            Icon(
              Icons.dark_mode_outlined,
              color: Color(0xFF0F62FE),
            ),
            SizedBox(width: 12),
            Text("Modo escuro"),
          ],
        ),
      ),

     
      const PopupMenuItem<String>(
        value: 'ler',
        child: Row(
          children: [
            Icon(
              Icons.volume_up,
              color: Color(0xFF0F62FE),
            ),
            SizedBox(width: 12),
            Text("Ler página"),
          ],
        ),
      ),
    ],
  ),

  // =================================================
  // ATUALIZAR
  // =================================================

  IconButton(
    icon: const Icon(
      Icons.refresh,
      color: Color(0xFF0F62FE),
    ),
    tooltip: "Atualizar dashboard",
    onPressed: carregando
        ? null
        : carregarDashboard,
  ),

  const SizedBox(width: 10),

  // =================================================
  // USUÁRIO
  // =================================================

  Row(
    children: [
      CircleAvatar(
        radius: 18,
        backgroundColor:
            const Color(0xFF0F62FE),
        child: Text(
          nome.isNotEmpty
              ? nome[0].toUpperCase()
              : "F",
          style: const TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
      ),

      const SizedBox(width: 8),

      Column(
        mainAxisAlignment:
            MainAxisAlignment.center,
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Text(
            nome,
            style: TextStyle(
              color: textColor,
              fontSize: 13,
              fontWeight: FontWeight.bold,
            ),
          ),
          Text(
            empresa,
            style: TextStyle(
              color: subTextColor,
              fontSize: 10,
            ),
          ),
        ],
      ),
    ],
  ),

  const SizedBox(width: 15),
],
      ),

      // =====================================================
      // BODY
      // =====================================================

      body: _buildBody(
        context,
        isDarkMode,
      ),
    );
  }

  // =========================================================
  // BODY
  // =========================================================

  Widget _buildBody(
    BuildContext context,
    bool isDarkMode,
  ) {
    if (carregando) {
      return const Center(
        child: CircularProgressIndicator(
          color: Color(0xFF0F62FE),
        ),
      );
    }

    if (erro != null) {
      return _buildErro();
    }

    if (dashboard == null) {
      return _buildErro(
        mensagem:
            "Nenhum dado foi encontrado.",
      );
    }

    return LayoutBuilder(
      builder: (context, constraints) {
        final bool isDesktop =
            constraints.maxWidth > 900;

        return RefreshIndicator(
          onRefresh: carregarDashboard,
          child: SingleChildScrollView(
            physics:
                const AlwaysScrollableScrollPhysics(),
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              children: [
                // ===========================================
                // SAUDAÇÃO
                // ===========================================

              

                const SizedBox(height: 24),

                // ===========================================
                // CARDS DE RESUMO
                // ===========================================


                // ===========================================
                // CALENDÁRIO + DICAS
                // ===========================================

                isDesktop
                    ? Row(
                        crossAxisAlignment:
                            CrossAxisAlignment.start,
                        children: [
                          Expanded(
                            flex: 3,
                            child: CalendarioEPI(
                              ocorrencias:
                                  dashboard!
                                      .ocorrencias
                                      .historico,
                            ),
                          ),

                          const SizedBox(width: 24),

                          const Expanded(
                            flex: 2,
                            child:
                                _DicasSeguranca(),
                          ),
                        ],
                      )
                    : Column(
                        children: [
                          CalendarioEPI(
                            ocorrencias:
                                dashboard!
                                    .ocorrencias
                                    .historico,
                          ),

                          const SizedBox(height: 24),

                          const _DicasSeguranca(),
                        ],
                      ),

                const SizedBox(height: 24),

                // ===========================================
                // ÚLTIMA VERIFICAÇÃO
                // ===========================================

              ],
            ),
          ),
        );
      },
    );
  }

  // =========================================================
  // SAUDAÇÃO
  // =========================================================

  // =========================================================
  // CARDS DE RESUMO
  // =========================================================

  Widget _buildCardsResumo(
    bool isDarkMode,
    bool isDesktop,
  ) {
    final ocorrencias =
        dashboard!.ocorrencias;

    final epis =
        dashboard!.epis;

    final cards = [
      _ResumoCard(
        titulo: "Ocorrências",
        valor:
            ocorrencias.total.toString(),
        descricao:
            "Total de análises realizadas",
        icone:
            Icons.analytics_outlined,
        cor: const Color(0xFF0F62FE),
        isDarkMode: isDarkMode,
      ),

      _ResumoCard(
        titulo: "Regulares",
        valor:
            ocorrencias.regulares.toString(),
        descricao:
            "Análises sem irregularidades",
        icone:
            Icons.check_circle_outline,
        cor: Colors.green,
        isDarkMode: isDarkMode,
      ),

      _ResumoCard(
        titulo: "Irregulares",
        valor:
            ocorrencias.irregulares.toString(),
        descricao:
            "Análises com irregularidades",
        icone:
            Icons.warning_amber_rounded,
        cor: Colors.red,
        isDarkMode: isDarkMode,
      ),

      _ResumoCard(
        titulo: "Meus EPIs",
        valor:
            epis.total.toString(),
        descricao:
            "EPIs vinculados ao funcionário",
        icone:
            Icons.health_and_safety_outlined,
        cor: const Color(0xFF7B61FF),
        isDarkMode: isDarkMode,
      ),
    ];

    if (isDesktop) {
      return Row(
        children: cards
            .map(
              (card) => Expanded(
                child: Padding(
                  padding:
                      const EdgeInsets.only(
                    right: 12,
                  ),
                  child: card,
                ),
              ),
            )
            .toList(),
      );
    }

    return Column(
      children: cards
          .map(
            (card) => Padding(
              padding:
                  const EdgeInsets.only(
                bottom: 12,
              ),
              child: card,
            ),
          )
          .toList(),
    );
  }

  // =========================================================
  // ÚLTIMA VERIFICAÇÃO
  // =========================================================

  Widget _buildUltimaVerificacao(
    bool isDarkMode,
  ) {
    final ultima =
        dashboard!.ocorrencias
            .ultimaVerificacao;

    final Color cardColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    final Color subTextColor = isDarkMode
        ? Colors.white70
        : Colors.grey;

    if (ultima == null) {
      return Container(
        width: double.infinity,
        padding: const EdgeInsets.all(24),
        decoration: BoxDecoration(
          color: cardColor,
          borderRadius:
              BorderRadius.circular(20),
        ),
        child: Row(
          children: [
            const Icon(
              Icons.info_outline,
              color: Color(0xFF0F62FE),
            ),
            const SizedBox(width: 12),
            Text(
              "Nenhuma verificação realizada ainda.",
              style: TextStyle(
                color: textColor,
                fontSize: 14,
              ),
            ),
          ],
        ),
      );
    }

    final bool regular =
        ultima.status.toLowerCase() ==
            "regular" ||
        ultima.status.toLowerCase() ==
            "correto" ||
        ultima.status.toLowerCase() ==
            "conforme";

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius:
            BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(
              0.03,
            ),
            blurRadius: 15,
            offset:
                const Offset(0, 5),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding:
                    const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: const Color(
                    0xFF0F62FE,
                  ),
                  borderRadius:
                      BorderRadius.circular(
                    12,
                  ),
                ),
                child: const Icon(
                  Icons.fact_check_outlined,
                  color: Colors.white,
                ),
              ),

              const SizedBox(width: 14),

              Column(
                crossAxisAlignment:
                    CrossAxisAlignment.start,
                children: [
                  Text(
                    "Última verificação",
                    style: TextStyle(
                      color: textColor,
                      fontSize: 19,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),
                  Text(
                    "Resultado da análise mais recente",
                    style: TextStyle(
                      color: subTextColor,
                      fontSize: 12,
                    ),
                  ),
                ],
              ),
            ],
          ),

          const SizedBox(height: 22),

          Wrap(
            spacing: 30,
            runSpacing: 15,
            children: [
              _InfoItem(
                titulo: "Data",
                valor:
                    ultima.dataAnalise,
                textColor:
                    textColor,
                subTextColor:
                    subTextColor,
              ),

              _InfoItem(
                titulo: "Horário",
                valor:
                    ultima.horaAnalise,
                textColor:
                    textColor,
                subTextColor:
                    subTextColor,
              ),

              _InfoItem(
                titulo: "Câmera",
                valor:
                    ultima.identificadorCamera
                            .isNotEmpty
                        ? ultima
                            .identificadorCamera
                        : "Não informado",
                textColor:
                    textColor,
                subTextColor:
                    subTextColor,
              ),

              _InfoItem(
                titulo: "Status",
                valor:
                    ultima.status.isNotEmpty
                        ? ultima.status
                        : "Não informado",
                textColor:
                    regular
                        ? Colors.green
                        : Colors.red,
                subTextColor:
                    subTextColor,
              ),
            ],
          ),

          if (ultima.episDetectados
                  .isNotEmpty ||
              ultima.episAusente
                  .isNotEmpty) ...[
            const SizedBox(height: 20),

            const Divider(),

            const SizedBox(height: 15),

            Text(
              "EPIs detectados",
              style: TextStyle(
                color: textColor,
                fontWeight:
                    FontWeight.bold,
                fontSize: 14,
              ),
            ),

            const SizedBox(height: 8),

            Text(
              ultima.episDetectados
                      .isNotEmpty
                  ? ultima.episDetectados
                  : "Nenhum informado",
              style: TextStyle(
                color: subTextColor,
                fontSize: 13,
              ),
            ),

            if (ultima.episAusente
                    .isNotEmpty) ...[
              const SizedBox(height: 12),

              Text(
                "EPIs ausentes",
                style: TextStyle(
                  color: Colors.red,
                  fontWeight:
                      FontWeight.bold,
                  fontSize: 14,
                ),
              ),

              const SizedBox(height: 8),

              Text(
                ultima.episAusente,
                style: TextStyle(
                  color: subTextColor,
                  fontSize: 13,
                ),
              ),
            ],
          ],
        ],
      ),
    );
  }

  // =========================================================
  // EPIs
  // =========================================================

  Widget _buildEpis(
    bool isDarkMode,
  ) {
    final epis =
        dashboard!.epis.lista;

    final Color cardColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    final Color subTextColor = isDarkMode
        ? Colors.white70
        : Colors.grey;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius:
            BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(
              0.03,
            ),
            blurRadius: 15,
            offset:
                const Offset(0, 5),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              const Icon(
                Icons.health_and_safety_outlined,
                color: Color(0xFF0F62FE),
                size: 27,
              ),
              const SizedBox(width: 10),
              Text(
                "Meus EPIs",
                style: TextStyle(
                  color: textColor,
                  fontSize: 20,
                  fontWeight:
                      FontWeight.bold,
                ),
              ),
            ],
          ),

          const SizedBox(height: 6),

          Text(
            "Equipamentos vinculados ao seu perfil",
            style: TextStyle(
              color: subTextColor,
              fontSize: 13,
            ),
          ),

          const SizedBox(height: 20),

          if (epis.isEmpty)
            Text(
              "Nenhum EPI cadastrado.",
              style: TextStyle(
                color: subTextColor,
              ),
            )
          else
            Wrap(
              spacing: 12,
              runSpacing: 12,
              children: epis
                  .map(
                    (epi) =>
                        _buildEpiItem(
                      epi,
                      isDarkMode,
                    ),
                  )
                  .toList(),
            ),
        ],
      ),
    );
  }

  Widget _buildEpiItem(
    DashboardEpi epi,
    bool isDarkMode,
  ) {
    final Color itemColor = isDarkMode
        ? const Color(0xFF2A3B5C)
        : const Color(0xFFF4F6FA);

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    return Container(
      width: 220,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: itemColor,
        borderRadius:
            BorderRadius.circular(15),
      ),
      child: Row(
        children: [
          Container(
            width: 42,
            height: 42,
            decoration: BoxDecoration(
              color: const Color(
                0xFF0F62FE,
              ).withOpacity(0.12),
              borderRadius:
                  BorderRadius.circular(
                12,
              ),
            ),
            child: const Icon(
              Icons.shield_outlined,
              color: Color(0xFF0F62FE),
            ),
          ),

          const SizedBox(width: 12),

          Expanded(
            child: Text(
              epi.nome.isNotEmpty
                  ? epi.nome
                  : "EPI",
              style: TextStyle(
                color: textColor,
                fontWeight:
                    FontWeight.w600,
                fontSize: 13,
              ),
            ),
          ),
        ],
      ),
    );
  }

  // =========================================================
  // CÂMERAS
  // =========================================================

  Widget _buildCameras(
    bool isDarkMode,
  ) {
    final cameras =
        dashboard!.cameras;

    final Color cardColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    final Color subTextColor = isDarkMode
        ? Colors.white70
        : Colors.grey;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius:
            BorderRadius.circular(20),
      ),
      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              const Icon(
                Icons.videocam_outlined,
                color: Color(0xFF0F62FE),
                size: 27,
              ),
              const SizedBox(width: 10),
              Text(
                "Câmeras do setor",
                style: TextStyle(
                  color: textColor,
                  fontSize: 20,
                  fontWeight:
                      FontWeight.bold,
                ),
              ),
            ],
          ),

          const SizedBox(height: 6),

          Text(
            "Câmeras vinculadas ao seu setor",
            style: TextStyle(
              color: subTextColor,
              fontSize: 13,
            ),
          ),

          const SizedBox(height: 20),

          if (cameras.isEmpty)
            Text(
              "Nenhuma câmera encontrada.",
              style: TextStyle(
                color: subTextColor,
              ),
            )
          else
            Column(
              children: cameras
                  .map(
                    (camera) =>
                        _CameraItem(
                      camera: camera,
                      isDarkMode:
                          isDarkMode,
                    ),
                  )
                  .toList(),
            ),
        ],
      ),
    );
  }

  // =========================================================
  // ERRO
  // =========================================================

  Widget _buildErro({
    String? mensagem,
  }) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(24),
        child: Column(
          mainAxisSize:
              MainAxisSize.min,
          children: [
            const Icon(
              Icons.error_outline,
              color: Colors.red,
              size: 52,
            ),

            const SizedBox(height: 16),

            const Text(
              "Não foi possível carregar o Dashboard",
              textAlign:
                  TextAlign.center,
              style: TextStyle(
                fontSize: 18,
                fontWeight:
                    FontWeight.bold,
              ),
            ),

            const SizedBox(height: 10),

            Text(
              mensagem ??
                  erro ??
                  "Verifique a conexão com a API.",
              textAlign:
                  TextAlign.center,
              style: const TextStyle(
                color: Colors.grey,
              ),
            ),

            const SizedBox(height: 22),

            ElevatedButton.icon(
              onPressed:
                  carregarDashboard,
              icon: const Icon(
                Icons.refresh,
              ),
              label: const Text(
                "Tentar novamente",
              ),
              style:
                  ElevatedButton.styleFrom(
                backgroundColor:
                    const Color(
                  0xFF0F62FE,
                ),
                foregroundColor:
                    Colors.white,
              ),
            ),
          ],
        ),
      ),
    );
  }

  // =========================================================
  // DRAWER
  // =========================================================

  Widget _buildDrawer(
    BuildContext context,
  ) {
    return Drawer(
      backgroundColor:
          const Color(0xFF071C30),
      child: Stack(
        children: [
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            height: 380,
            child: Image.asset(
              "assets/funci.png",
              fit: BoxFit.cover,
              alignment:
                  Alignment.bottomCenter,
              errorBuilder:
                  (context, error, stackTrace) {
                return Image.asset(
                  "assets/funci.webp",
                  fit: BoxFit.cover,
                  alignment:
                      Alignment.bottomCenter,
                  errorBuilder:
                      (context, error,
                          stackTrace) {
                    return const SizedBox();
                  },
                );
              },
            ),
          ),

          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            height: 380,
            child: Container(
              decoration:
                  BoxDecoration(
                gradient:
                    LinearGradient(
                  begin:
                      Alignment.topCenter,
                  end:
                      Alignment.bottomCenter,
                  colors: [
                    const Color(
                      0xFF071C30,
                    ),
                    const Color(
                      0xFF071C30,
                    ).withOpacity(0.65),
                  ],
                ),
              ),
            ),
          ),

          SafeArea(
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              children: [
                Padding(
                  padding:
                      const EdgeInsets
                          .symmetric(
                    horizontal: 20,
                    vertical: 20,
                  ),
                  child: Row(
                    children: [
                      Image.asset(
                        'assets/logo.nexa.png',
                        height: 36,
                        errorBuilder:
                            (
                          context,
                          error,
                          stackTrace,
                        ) {
                          return const Icon(
                            Icons
                                .shield_outlined,
                            color:
                                Colors.white,
                            size: 36,
                          );
                        },
                      ),

                      const SizedBox(
                        width: 14,
                      ),

                      const Column(
                        crossAxisAlignment:
                            CrossAxisAlignment
                                .start,
                        children: [
                          Text(
                            "NEXA",
                            style:
                                TextStyle(
                              color:
                                  Colors.white,
                              fontSize:
                                  22,
                              fontWeight:
                                  FontWeight
                                      .bold,
                              letterSpacing:
                                  1.2,
                            ),
                          ),
                          Text(
                            "Segurança é prioridade",
                            style:
                                TextStyle(
                              color:
                                  Colors.white70,
                              fontSize:
                                  11,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),

                const SizedBox(
                  height: 10,
                ),

                const Padding(
                  padding:
                      EdgeInsets
                          .symmetric(
                    horizontal: 20,
                    vertical: 8,
                  ),
                  child: Text(
                    "PRINCIPAL",
                    style:
                        TextStyle(
                      color:
                          Colors.white54,
                      fontSize: 11,
                      fontWeight:
                          FontWeight.bold,
                      letterSpacing:
                          1.1,
                    ),
                  ),
                ),

                _menuItem(
                  icon: Icons
                      .grid_view_rounded,
                  texto: "Dashboard",
                  isSelected: true,
                  onTap: () {
                    Navigator.pop(
                      context,
                    );
                  },
                ),

                _menuItem(
                  icon: Icons
                      .videocam_outlined,
                  texto:
                      "Análise de EPI",
                  isSelected: false,
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) =>
                            const DashboardCameraPage(),
                      ),
                    );
                  },
                ),

                const SizedBox(
                  height: 20,
                ),

                const Padding(
                  padding:
                      EdgeInsets
                          .symmetric(
                    horizontal: 20,
                    vertical: 8,
                  ),
                  child: Text(
                    "CONTA",
                    style:
                        TextStyle(
                      color:
                          Colors.white54,
                      fontSize: 11,
                      fontWeight:
                          FontWeight.bold,
                      letterSpacing:
                          1.1,
                    ),
                  ),
                ),

                _menuItem(
                  icon: Icons
                      .person_outline,
                  texto: "Perfil",
                  isSelected: false,
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) =>
                            const PerfilPage(),
                      ),
                    );
                  },
                ),

                const Spacer(),

                Padding(
                  padding:
                      const EdgeInsets
                          .all(20),
                  child:
                      OutlinedButton(
                    onPressed: () {
                      Navigator
                          .pushAndRemoveUntil(
                        context,
                        MaterialPageRoute(
                          builder: (_) =>
                              InstitucionalPage(),
                        ),
                        (route) =>
                            false,
                      );
                    },
                    style: OutlinedButton
                        .styleFrom(
                      backgroundColor:
                          Colors.black
                              .withOpacity(
                        0.2,
                      ),
                      side:
                          const BorderSide(
                        color:
                            Colors.white38,
                        width: 1,
                      ),
                      minimumSize:
                          const Size(
                        double.infinity,
                        50,
                      ),
                      shape:
                          RoundedRectangleBorder(
                        borderRadius:
                            BorderRadius
                                .circular(
                          25,
                        ),
                      ),
                    ),
                    child:
                        const Row(
                      mainAxisAlignment:
                          MainAxisAlignment
                              .center,
                      children: [
                        Icon(
                          Icons.logout,
                          color:
                              Colors.white,
                          size: 20,
                        ),
                        SizedBox(
                          width: 10,
                        ),
                        Text(
                          "Sair do Sistema",
                          style:
                              TextStyle(
                            color:
                                Colors.white,
                            fontSize:
                                15,
                            fontWeight:
                                FontWeight
                                    .bold,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}


// =========================================================
// MENU ITEM
// =========================================================

Widget _menuItem({
  required IconData icon,
  required String texto,
  required VoidCallback onTap,
  bool isSelected = false,
}) {
  return Padding(
    padding:
        const EdgeInsets.symmetric(
      horizontal: 16,
      vertical: 3,
    ),
    child: InkWell(
      borderRadius:
          BorderRadius.circular(12),
      onTap: onTap,
      child: Container(
        padding:
            const EdgeInsets.symmetric(
          vertical: 12,
          horizontal: 16,
        ),
        decoration:
            BoxDecoration(
          color: isSelected
              ? const Color(
                  0xFF0075E3,
                )
              : Colors.transparent,
          borderRadius:
              BorderRadius.circular(12),
        ),
        child: Row(
          children: [
            Icon(
              icon,
              color: Colors.white,
              size: 22,
            ),
            const SizedBox(
              width: 15,
            ),
            Text(
              texto,
              style:
                  const TextStyle(
                color: Colors.white,
                fontSize: 15,
                fontWeight:
                    FontWeight.w500,
              ),
            ),
          ],
        ),
      ),
    ),
  );
}


// =========================================================
// CALENDÁRIO
// =========================================================

class CalendarioEPI extends StatefulWidget {
  final List<DashboardOcorrencia>
      ocorrencias;

  const CalendarioEPI({
    super.key,
    required this.ocorrencias,
  });

  @override
  State<CalendarioEPI> createState() =>
      _CalendarioEPIState();
}

class _CalendarioEPIState
    extends State<CalendarioEPI> {
  DateTime dataAtual =
      DateTime.now();

  final meses = [
    "JAN",
    "FEV",
    "MAR",
    "ABR",
    "MAI",
    "JUN",
    "JUL",
    "AGO",
    "SET",
    "OUT",
    "NOV",
    "DEZ",
  ];

  // =========================================================
  // RETORNA OCORRÊNCIAS DO DIA
  // =========================================================

  List<DashboardOcorrencia>
      ocorrenciasDoDia(
    int dia,
  ) {
    return widget.ocorrencias
        .where(
          (ocorrencia) {
            final partes =
                ocorrencia.dataAnalise
                    .split('-');

            if (partes.length != 3) {
              return false;
            }

            final ano =
                int.tryParse(
                      partes[0],
                    ) ??
                    0;

            final mes =
                int.tryParse(
                      partes[1],
                    ) ??
                    0;

            final diaOcorrencia =
                int.tryParse(
                      partes[2],
                    ) ??
                    0;

            return ano ==
                    dataAtual.year &&
                mes ==
                    dataAtual.month &&
                diaOcorrencia ==
                    dia;
          },
        )
        .toList();
  }
void _abrirDetalhesOcorrencias(
  BuildContext context,
  List<DashboardOcorrencia> ocorrencias,
  bool isDarkMode,
) {
  if (ocorrencias.isEmpty) {
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text("Não há ocorrências neste dia."),
        backgroundColor: Colors.grey,
      ),
    );
    return;
  }

  final Color cardColor = isDarkMode
      ? const Color(0xFF1A2B4C)
      : Colors.white;

  final Color textColor = isDarkMode
      ? Colors.white
      : const Color(0xFF161616);

  final Color subTextColor = isDarkMode
      ? Colors.white70
      : Colors.grey;

  showDialog(
    context: context,
    builder: (dialogContext) {
      return Dialog(
        backgroundColor: cardColor,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(22),
        ),
        child: ConstrainedBox(
          constraints: const BoxConstraints(
            maxWidth: 650,
            maxHeight: 700,
          ),
          child: Padding(
            padding: const EdgeInsets.all(26),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [

                // =================================================
                // CABEÇALHO
                // =================================================

                Row(
                  children: [
                    Container(
                      width: 48,
                      height: 48,
                      decoration: BoxDecoration(
                        color: const Color(0xFF0F62FE)
                            .withOpacity(0.12),
                        borderRadius:
                            BorderRadius.circular(14),
                      ),
                      child: const Icon(
                        Icons.fact_check_outlined,
                        color: Color(0xFF0F62FE),
                        size: 27,
                      ),
                    ),

                    const SizedBox(width: 14),

                    Expanded(
                      child: Column(
                        crossAxisAlignment:
                            CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Detalhamento das ocorrências",
                            style: TextStyle(
                              color: textColor,
                              fontSize: 19,
                              fontWeight: FontWeight.bold,
                            ),
                          ),

                          const SizedBox(height: 4),

                          Text(
                            "${ocorrencias.length} ocorrência(s) encontrada(s)",
                            style: TextStyle(
                              color: subTextColor,
                              fontSize: 12,
                            ),
                          ),
                        ],
                      ),
                    ),

                    IconButton(
                      onPressed: () {
                        Navigator.pop(dialogContext);
                      },
                      icon: Icon(
                        Icons.close,
                        color: subTextColor,
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 20),

                const Divider(),

                const SizedBox(height: 10),

                // =================================================
                // LISTA DE OCORRÊNCIAS
                // =================================================

                Flexible(
                  child: ListView.separated(
                    shrinkWrap: true,
                    itemCount: ocorrencias.length,
                    separatorBuilder: (_, __) =>
                        const SizedBox(height: 14),
                    itemBuilder: (context, index) {
                      final ocorrencia =
                          ocorrencias[index];

                      final String status =
                          ocorrencia.status.isNotEmpty
                              ? ocorrencia.status
                              : "Não informado";

                      final String statusLower =
                          status.toLowerCase();

                      final bool irregular =
                          statusLower.contains("irregular") ||
                          statusLower.contains("erro") ||
                          statusLower.contains("inconforme");

                      final Color statusColor =
                          irregular
                              ? Colors.red
                              : Colors.green;

                      return Container(
                        padding:
                            const EdgeInsets.all(18),
                        decoration: BoxDecoration(
                          color: isDarkMode
                              ? const Color(0xFF2A3B5C)
                              : const Color(0xFFF4F6FA),
                          borderRadius:
                              BorderRadius.circular(16),
                          border: Border.all(
                            color: statusColor
                                .withOpacity(0.18),
                          ),
                        ),
                        child: Column(
                          crossAxisAlignment:
                              CrossAxisAlignment.start,
                          children: [

                            // =====================================
                            // NÚMERO + STATUS
                            // =====================================

                            Row(
                              children: [
                                Expanded(
                                  child: Text(
                                    "Ocorrência ${index + 1}",
                                    style: TextStyle(
                                      color: textColor,
                                      fontSize: 16,
                                      fontWeight:
                                          FontWeight.bold,
                                    ),
                                  ),
                                ),

                                Container(
                                  padding:
                                      const EdgeInsets
                                          .symmetric(
                                    horizontal: 11,
                                    vertical: 6,
                                  ),
                                  decoration: BoxDecoration(
                                    color: statusColor
                                        .withOpacity(0.12),
                                    borderRadius:
                                        BorderRadius.circular(
                                      20,
                                    ),
                                  ),
                                  child: Row(
                                    mainAxisSize:
                                        MainAxisSize.min,
                                    children: [
                                      Icon(
                                        irregular
                                            ? Icons
                                                .warning_amber_rounded
                                            : Icons
                                                .check_circle_outline,
                                        color:
                                            statusColor,
                                        size: 16,
                                      ),

                                      const SizedBox(
                                        width: 5,
                                      ),

                                      Text(
                                        status,
                                        style: TextStyle(
                                          color:
                                              statusColor,
                                          fontSize: 11,
                                          fontWeight:
                                              FontWeight.bold,
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ],
                            ),

                            const SizedBox(height: 18),

                            // =====================================
                            // DATA / HORÁRIO / CÂMERA
                            // =====================================

                            Wrap(
                              spacing: 30,
                              runSpacing: 15,
                              children: [
                                _DetalheItem(
                                  icone:
                                      Icons.calendar_today,
                                  titulo: "Data",
                                  valor:
                                      ocorrencia.dataAnalise,
                                  textColor:
                                      textColor,
                                  subTextColor:
                                      subTextColor,
                                ),

                                _DetalheItem(
                                  icone:
                                      Icons.access_time,
                                  titulo: "Horário",
                                  valor:
                                      ocorrencia.horaAnalise,
                                  textColor:
                                      textColor,
                                  subTextColor:
                                      subTextColor,
                                ),

                                _DetalheItem(
                                  icone:
                                      Icons.videocam_outlined,
                                  titulo: "Câmera",
                                  valor:
                                      ocorrencia
                                              .identificadorCamera
                                              .isNotEmpty
                                          ? ocorrencia
                                              .identificadorCamera
                                          : "Não informado",
                                  textColor:
                                      textColor,
                                  subTextColor:
                                      subTextColor,
                                ),
                              ],
                            ),

                            // =====================================
                            // EPIS DETECTADOS
                            // =====================================

                            if (ocorrencia
                                    .episDetectados
                                    .isNotEmpty) ...[
                              const SizedBox(height: 20),

                              Text(
                                "EPIs detectados",
                                style: TextStyle(
                                  color: textColor,
                                  fontSize: 13,
                                  fontWeight:
                                      FontWeight.bold,
                                ),
                              ),

                              const SizedBox(height: 8),

                              Container(
                                width: double.infinity,
                                padding:
                                    const EdgeInsets.all(
                                  12,
                                ),
                                decoration:
                                    BoxDecoration(
                                  color: Colors.green
                                      .withOpacity(0.08),
                                  borderRadius:
                                      BorderRadius.circular(
                                    10,
                                  ),
                                ),
                                child: Text(
                                  ocorrencia
                                      .episDetectados,
                                  style: TextStyle(
                                    color:
                                        isDarkMode
                                            ? Colors.white70
                                            : Colors.black87,
                                    fontSize: 12,
                                  ),
                                ),
                              ),
                            ],

                            // =====================================
                            // EPIS AUSENTES
                            // =====================================

                            if (ocorrencia
                                    .episAusente
                                    .isNotEmpty) ...[
                              const SizedBox(height: 14),

                              Text(
                                "EPIs ausentes",
                                style: const TextStyle(
                                  color: Colors.red,
                                  fontSize: 13,
                                  fontWeight:
                                      FontWeight.bold,
                                ),
                              ),

                              const SizedBox(height: 8),

                              Container(
                                width: double.infinity,
                                padding:
                                    const EdgeInsets.all(
                                  12,
                                ),
                                decoration:
                                    BoxDecoration(
                                  color: Colors.red
                                      .withOpacity(0.08),
                                  borderRadius:
                                      BorderRadius.circular(
                                    10,
                                  ),
                                ),
                                child: Text(
                                  ocorrencia.episAusente,
                                  style: TextStyle(
                                    color:
                                        isDarkMode
                                            ? Colors.white70
                                            : Colors.black87,
                                    fontSize: 12,
                                  ),
                                ),
                              ),
                            ],
                          ],
                        ),
                      );
                    },
                  ),
                ),

                const SizedBox(height: 20),

                // =================================================
                // BOTÃO FECHAR
                // =================================================

                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    onPressed: () {
                      Navigator.pop(dialogContext);
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor:
                          const Color(0xFF0F62FE),
                      foregroundColor: Colors.white,
                      padding:
                          const EdgeInsets.symmetric(
                        vertical: 14,
                      ),
                      shape: RoundedRectangleBorder(
                        borderRadius:
                            BorderRadius.circular(12),
                      ),
                    ),
                    child: const Text(
                      "Fechar",
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      );
    },
  );
}
  @override
  Widget build(
    BuildContext context,
  ) {
    final accessibility =
        context.watch<
            AccessibilityController>();

    bool isDarkMode = false;

    try {
      isDarkMode =
          (accessibility as dynamic)
                  .darkMode ??
              (accessibility as dynamic)
                  .isDarkMode ??
              false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color cardColor =
        isDarkMode
            ? const Color(
                0xFF1A2B4C,
              )
            : Colors.white;

    final Color textColor =
        isDarkMode
            ? Colors.white
            : const Color(
                0xFF161616,
              );

    final Color subTextColor =
        isDarkMode
            ? Colors.white70
            : Colors.grey;

    final Color itemColor =
        isDarkMode
            ? const Color(
                0xFF2A3B5C,
              )
            : const Color(
                0xFFF4F6FA,
              );

    final int mes =
        dataAtual.month;

    final int ano =
        dataAtual.year;

    final int diasNoMes =
        DateTime(
      ano,
      mes + 1,
      0,
    ).day;

    return Container(
      padding:
          const EdgeInsets.all(24),
      decoration:
          BoxDecoration(
        color: cardColor,
        borderRadius:
            BorderRadius.circular(
          20,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black
                .withOpacity(
              0.03,
            ),
            blurRadius: 15,
            offset:
                const Offset(0, 5),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding:
                    const EdgeInsets.all(
                  10,
                ),
                decoration:
                    BoxDecoration(
                  color:
                      const Color(
                    0xFF0F62FE,
                  ),
                  borderRadius:
                      BorderRadius.circular(
                    12,
                  ),
                ),
                child:
                    const Icon(
                  Icons
                      .calendar_month_rounded,
                  color:
                      Colors.white,
                  size: 22,
                ),
              ),

              const SizedBox(
                width: 15,
              ),

              Column(
                crossAxisAlignment:
                    CrossAxisAlignment
                        .start,
                children: [
                  Text(
                    "Calendário",
                    style:
                        TextStyle(
                      fontSize: 20,
                      fontWeight:
                          FontWeight
                              .bold,
                      color:
                          textColor,
                    ),
                  ),
                  Text(
                    "Visualize os dias e suas atividades",
                    style:
                        TextStyle(
                      fontSize: 13,
                      color:
                          subTextColor,
                    ),
                  ),
                ],
              ),
            ],
          ),

          const SizedBox(
            height: 25,
          ),

          Row(
            mainAxisAlignment:
                MainAxisAlignment
                    .spaceBetween,
            children: [
              IconButton(
                icon:
                    const Icon(
                  Icons.arrow_left,
                  color:
                      Color(
                    0xFF0F62FE,
                  ),
                  size: 30,
                ),
                onPressed: () {
                  setState(() {
                    dataAtual =
                        DateTime(
                      dataAtual.year,
                      dataAtual.month -
                          1,
                      1,
                    );
                  });
                },
              ),

              Column(
                children: [
                  Text(
                    meses[mes - 1],
                    style:
                        const TextStyle(
                      fontWeight:
                          FontWeight
                              .bold,
                      fontSize: 18,
                      color:
                          Color(
                        0xFF0F62FE,
                      ),
                    ),
                  ),
                  Text(
                    "$ano",
                    style:
                        TextStyle(
                      fontSize: 12,
                      color:
                          subTextColor,
                    ),
                  ),
                ],
              ),

              IconButton(
                icon:
                    const Icon(
                  Icons.arrow_right,
                  color:
                      Color(
                    0xFF0F62FE,
                  ),
                  size: 30,
                ),
                onPressed: () {
                  setState(() {
                    dataAtual =
                        DateTime(
                      dataAtual.year,
                      dataAtual.month +
                          1,
                      1,
                    );
                  });
                },
              ),
            ],
          ),

          const SizedBox(
            height: 15,
          ),

          GridView.builder(
            shrinkWrap: true,
            physics:
                const NeverScrollableScrollPhysics(),
            itemCount:
                diasNoMes,
            gridDelegate:
                const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 7,
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              childAspectRatio: 1.2,
            ),
            itemBuilder:
                (context, index) {
              final int dia =
                  index + 1;

              final ocorrencias =
                  ocorrenciasDoDia(
                dia,
              );

              Color bolinha =
                  Colors.grey;

              if (ocorrencias
                  .isNotEmpty) {
                final bool temErro =
                    ocorrencias.any(
                  (ocorrencia) {
                    final status =
                        ocorrencia
                            .status
                            .toLowerCase();

                    return status
                            .contains(
                          "irregular",
                        ) ||
                        status
                            .contains(
                          "erro",
                        ) ||
                        status
                            .contains(
                          "inconforme",
                        );
                  },
                );

                bolinha = temErro
                    ? Colors.red
                    : Colors.green;
              }

              return Tooltip(
  message: ocorrencias.isEmpty
      ? "Sem registros"
      : "${ocorrencias.length} ocorrência(s)",
  child: InkWell(
    borderRadius: BorderRadius.circular(10),

    onTap: () {
      if (ocorrencias.isNotEmpty) {
        _abrirDetalhesOcorrencias(
          context,
          ocorrencias,
          isDarkMode,
        );
      }
    },

    child: Container(
      decoration: BoxDecoration(
        color: itemColor,
        borderRadius: BorderRadius.circular(10),
      ),

      child: Column(
        mainAxisAlignment:
            MainAxisAlignment.center,
        children: [
          Text(
            "$dia",
            style: const TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 15,
              color: Color(0xFF0F62FE),
            ),
          ),

          const SizedBox(height: 4),

          CircleAvatar(
            radius: 3,
            backgroundColor: bolinha,
          ),
        ],
      ),
    ),
  ),
);
            },
          ),

          const SizedBox(
            height: 25,
          ),

          Row(
            children: [
              _LegendaItem(
                cor: Colors.green,
                texto: "Correto",
                isDarkMode:
                    isDarkMode,
              ),
              const SizedBox(
                width: 15,
              ),
              _LegendaItem(
                cor: Colors.red,
                texto: "Erro",
                isDarkMode:
                    isDarkMode,
              ),
              const SizedBox(
                width: 15,
              ),
              _LegendaItem(
                cor: Colors.grey,
                texto: "Sem registro",
                isDarkMode:
                    isDarkMode,
              ),
            ],
          ),
        ],
      ),
    );
  }
}


// =========================================================
// LEGENDA
// =========================================================

class _LegendaItem
    extends StatelessWidget {
  final Color cor;
  final String texto;
  final bool isDarkMode;

  const _LegendaItem({
    required this.cor,
    required this.texto,
    required this.isDarkMode,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    return Row(
      children: [
        CircleAvatar(
          radius: 4,
          backgroundColor: cor,
        ),
        const SizedBox(
          width: 6,
        ),
        Text(
          texto,
          style:
              TextStyle(
            fontSize: 12,
            color:
                isDarkMode
                    ? Colors.white70
                    : Colors.black87,
          ),
        ),
      ],
    );
  }
}


// =========================================================
// DICAS DE SEGURANÇA
// =========================================================

class _DicasSeguranca
    extends StatelessWidget {
  const _DicasSeguranca();

  @override
  Widget build(
    BuildContext context,
  ) {
    final accessibility =
        context.watch<
            AccessibilityController>();

    bool isDarkMode = false;

    try {
      isDarkMode =
          (accessibility as dynamic)
                  .darkMode ??
              (accessibility as dynamic)
                  .isDarkMode ??
              false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color cardColor =
        isDarkMode
            ? const Color(
                0xFF1A2B4C,
              )
            : const Color(
                0xFFEBF3FF,
              );

    return Container(
      padding:
          const EdgeInsets.all(24),
      decoration:
          BoxDecoration(
        color: cardColor,
        borderRadius:
            BorderRadius.circular(
          20,
        ),
      ),
      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment
                .start,
        children: [
          const Row(
            children: [
              Icon(
                Icons.shield_outlined,
                color:
                    Color(
                  0xFF0F62FE,
                ),
                size: 26,
              ),
              SizedBox(
                width: 10,
              ),
              Text(
                "Dicas de\nSegurança",
                style:
                    TextStyle(
                  fontSize: 20,
                  fontWeight:
                      FontWeight
                          .bold,
                  color:
                      Color(
                    0xFF0F62FE,
                  ),
                  height: 1.1,
                ),
              ),
            ],
          ),

          const SizedBox(
            height: 20,
          ),

          _cardDica(
            icon:
                Icons.security_outlined,
            texto:
                "Use sempre EPIs completos",
            isDarkMode:
                isDarkMode,
          ),

          _cardDica(
            icon:
                Icons.check_circle_outline,
            texto:
                "Verifique seus equipamentos",
            isDarkMode:
                isDarkMode,
          ),

          _cardDica(
            icon:
                Icons.warning_amber_rounded,
            texto:
                "Atenção às áreas de risco",
            isDarkMode:
                isDarkMode,
          ),

          _cardDica(
            icon:
                Icons.description_outlined,
            texto:
                "Siga as normas da empresa",
            isDarkMode:
                isDarkMode,
          ),
        ],
      ),
    );
  }

  Widget _cardDica({
    required IconData icon,
    required String texto,
    required bool isDarkMode,
  }) {
    final Color itemCardColor =
        isDarkMode
            ? const Color(
                0xFF2A3B5C,
              )
            : Colors.white;

    final Color itemTextColor =
        isDarkMode
            ? Colors.white
            : const Color(
                0xFF161616,
              );

    final Color iconBgColor =
        isDarkMode
            ? const Color(
                0xFF1A2B4C,
              )
            : const Color(
                0xFFEBF3FF,
              );

    return Container(
      margin:
          const EdgeInsets.only(
        bottom: 12,
      ),
      padding:
          const EdgeInsets.all(16),
      decoration:
          BoxDecoration(
        color: itemCardColor,
        borderRadius:
            BorderRadius.circular(
          16,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black
                .withOpacity(
              0.02,
            ),
            blurRadius: 8,
            offset:
                const Offset(0, 2),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding:
                const EdgeInsets.all(
              8,
            ),
            decoration:
                BoxDecoration(
              color: iconBgColor,
              borderRadius:
                  BorderRadius.circular(
                10,
              ),
            ),
            child: Icon(
              icon,
              color:
                  const Color(
                0xFF0F62FE,
              ),
              size: 20,
            ),
          ),

          const SizedBox(
            width: 12,
          ),

          Expanded(
            child: Text(
              texto,
              style:
                  TextStyle(
                fontSize: 13,
                fontWeight:
                    FontWeight
                        .w600,
                color:
                    itemTextColor,
              ),
            ),
          ),
        ],
      ),
    );
  }
}


// =========================================================
// CARD DE RESUMO
// =========================================================

class _ResumoCard
    extends StatelessWidget {
  final String titulo;
  final String valor;
  final String descricao;
  final IconData icone;
  final Color cor;
  final bool isDarkMode;

  const _ResumoCard({
    required this.titulo,
    required this.valor,
    required this.descricao,
    required this.icone,
    required this.cor,
    required this.isDarkMode,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    return Container(
      padding:
          const EdgeInsets.all(20),
      decoration:
          BoxDecoration(
        color: isDarkMode
            ? const Color(
                0xFF1A2B4C,
              )
            : Colors.white,
        borderRadius:
            BorderRadius.circular(
          18,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black
                .withOpacity(
              0.03,
            ),
            blurRadius: 12,
            offset:
                const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            width: 48,
            height: 48,
            decoration:
                BoxDecoration(
              color: cor.withOpacity(
                0.12,
              ),
              borderRadius:
                  BorderRadius.circular(
                14,
              ),
            ),
            child: Icon(
              icone,
              color: cor,
              size: 25,
            ),
          ),

          const SizedBox(
            width: 14,
          ),

          Expanded(
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment
                      .start,
              children: [
                Text(
                  titulo,
                  style:
                      TextStyle(
                    color:
                        isDarkMode
                            ? Colors.white70
                            : Colors.grey,
                    fontSize: 12,
                  ),
                ),

                const SizedBox(
                  height: 3,
                ),

                Text(
                  valor,
                  style:
                      TextStyle(
                    color:
                        isDarkMode
                            ? Colors.white
                            : const Color(
                                0xFF161616,
                              ),
                    fontSize: 25,
                    fontWeight:
                        FontWeight
                            .bold,
                  ),
                ),

                const SizedBox(
                  height: 3,
                ),

                Text(
                  descricao,
                  maxLines: 2,
                  overflow:
                      TextOverflow
                          .ellipsis,
                  style:
                      TextStyle(
                    color:
                        isDarkMode
                            ? Colors.white54
                            : Colors.grey,
                    fontSize: 10,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _DetalheItem extends StatelessWidget {
  final IconData icone;
  final String titulo;
  final String valor;
  final Color textColor;
  final Color subTextColor;

  const _DetalheItem({
    required this.icone,
    required this.titulo,
    required this.valor,
    required this.textColor,
    required this.subTextColor,
  });

  @override
  Widget build(BuildContext context) {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Container(
          width: 34,
          height: 34,
          decoration: BoxDecoration(
            color: const Color(0xFF0F62FE)
                .withOpacity(0.10),
            borderRadius: BorderRadius.circular(9),
          ),
          child: Icon(
            icone,
            color: const Color(0xFF0F62FE),
            size: 17,
          ),
        ),

        const SizedBox(width: 9),

        Column(
          crossAxisAlignment:
              CrossAxisAlignment.start,
          children: [
            Text(
              titulo,
              style: TextStyle(
                color: subTextColor,
                fontSize: 10,
              ),
            ),

            const SizedBox(height: 2),

            Text(
              valor,
              style: TextStyle(
                color: textColor,
                fontSize: 12,
                fontWeight: FontWeight.w600,
              ),
            ),
          ],
        ),
      ],
    );
  }
}
// =========================================================
// ITEM DE INFORMAÇÃO
// =========================================================

class _InfoItem
    extends StatelessWidget {
  final String titulo;
  final String valor;
  final Color textColor;
  final Color subTextColor;

  const _InfoItem({
    required this.titulo,
    required this.valor,
    required this.textColor,
    required this.subTextColor,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    return Column(
      crossAxisAlignment:
          CrossAxisAlignment
              .start,
      children: [
        Text(
          titulo,
          style:
              TextStyle(
            color:
                subTextColor,
            fontSize: 11,
          ),
        ),

        const SizedBox(
          height: 4,
        ),

        Text(
          valor,
          style:
              TextStyle(
            color:
                textColor,
            fontSize: 14,
            fontWeight:
                FontWeight.w600,
          ),
        ),
      ],
    );
  }
}


// =========================================================
// ITEM DE CÂMERA
// =========================================================

class _CameraItem
    extends StatelessWidget {
  final DashboardCamera camera;
  final bool isDarkMode;

  const _CameraItem({
    required this.camera,
    required this.isDarkMode,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    final bool ativa =
        camera.status
            .toLowerCase()
            .contains("ativa");

    return Container(
      width: double.infinity,
      margin:
          const EdgeInsets.only(
        bottom: 10,
      ),
      padding:
          const EdgeInsets.all(15),
      decoration:
          BoxDecoration(
        color: isDarkMode
            ? const Color(
                0xFF2A3B5C,
              )
            : const Color(
                0xFFF4F6FA,
              ),
        borderRadius:
            BorderRadius.circular(
          14,
        ),
      ),
      child: Row(
        children: [
          Container(
            width: 42,
            height: 42,
            decoration:
                BoxDecoration(
              color:
                  const Color(
                0xFF0F62FE,
              ).withOpacity(
                0.12,
              ),
              borderRadius:
                  BorderRadius.circular(
                11,
              ),
            ),
            child: const Icon(
              Icons.videocam_outlined,
              color:
                  Color(
                0xFF0F62FE,
              ),
            ),
          ),

          const SizedBox(
            width: 12,
          ),

          Expanded(
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment
                      .start,
              children: [
                Text(
                  camera.identificador
                          .isNotEmpty
                      ? camera
                          .identificador
                      : "Câmera",
                  style:
                      TextStyle(
                    color:
                        isDarkMode
                            ? Colors.white
                            : const Color(
                                0xFF161616,
                              ),
                    fontWeight:
                        FontWeight
                            .w600,
                    fontSize: 14,
                  ),
                ),

                const SizedBox(
                  height: 4,
                ),

                Text(
                  camera.status
                          .isNotEmpty
                      ? camera.status
                      : "Status não informado",
                  style:
                      TextStyle(
                    color:
                        isDarkMode
                            ? Colors.white70
                            : Colors.grey,
                    fontSize: 11,
                  ),
                ),
              ],
            ),
          ),

          Container(
            padding:
                const EdgeInsets
                    .symmetric(
              horizontal: 10,
              vertical: 5,
            ),
            decoration:
                BoxDecoration(
              color: ativa
                  ? Colors.green
                      .withOpacity(
                      0.12,
                    )
                  : Colors.red
                      .withOpacity(
                      0.12,
                    ),
              borderRadius:
                  BorderRadius.circular(
                20,
              ),
            ),
            child: Text(
              ativa
                  ? "ATIVA"
                  : "INATIVA",
              style:
                  TextStyle(
                color: ativa
                    ? Colors.green
                    : Colors.red,
                fontSize: 10,
                fontWeight:
                    FontWeight
                        .bold,
              ),
            ),
          ),
        ],
      ),
    );
  }
}