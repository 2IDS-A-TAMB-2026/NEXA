import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/institucional_page.dart';

////////////////////////////////////////////////////////////
/// APP BAR GLOBAL COM ACESSIBILIDADE
////////////////////////////////////////////////////////////
PreferredSizeWidget menuAppBar(BuildContext context) {
  Provider.of<AccessibilityController>(context);

  final theme = Theme.of(context);

  Widget botao(String texto, VoidCallback onPressed) {
    return Container(
      decoration: BoxDecoration(
        color: theme.colorScheme.primary,
        borderRadius: BorderRadius.circular(30),
      ),
      child: TextButton(
        onPressed: onPressed,
        child: Text(
          texto,
          style: TextStyle(color: theme.colorScheme.onPrimary),
        ),
      ),
    );
  }

  return AppBar(
    title: Row(
      children: [
        Image.asset('assets/logo.png', height: 30),
        const SizedBox(width: 10),
        const Text("NEXA"),
      ],
    ),
  );
}

////////////////////////////////////////////////////////////
/// APP PRINCIPAL
////////////////////////////////////////////////////////////
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<AccessibilityController>(
      builder: (context, acess, _) {
        final colorScheme = acess.altoContraste
            ? const ColorScheme.highContrastDark()
            : ColorScheme.fromSeed(seedColor: const Color(0xFF0F2A44));

        return MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'NEXA',

          ////////////////////////////////////////////////////
          /// 🔥 ESCALA GLOBAL REAL
          ////////////////////////////////////////////////////
          builder: (context, child) {
            return MediaQuery(
              data: MediaQuery.of(
                context,
              ).copyWith(textScaler: TextScaler.linear(acess.escalaFonte)),
              child: child!,
            );
          },

          ////////////////////////////////////////////////////
          /// 🔥 TEMA MODERNO (FUNCIONA)
          ////////////////////////////////////////////////////
          theme: ThemeData(
            useMaterial3: true,
            colorScheme: colorScheme,

            scaffoldBackgroundColor: colorScheme.background,

            appBarTheme: AppBarTheme(
              backgroundColor: colorScheme.surface,
              foregroundColor: colorScheme.onSurface,
            ),
          ),

          home: const InstitucionalPage(),
        );
      },
    );
  }
}

////////////////////////////////////////////////////////////
/// MAIN
////////////////////////////////////////////////////////////
void main() {
  runApp(
    ChangeNotifierProvider(
      create: (_) => AccessibilityController(),
      child: const MyApp(),
    ),
  );
}
