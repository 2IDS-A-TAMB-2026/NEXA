import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:provider/provider.dart';

////////////////////////////////////////////////////////////
/// APP BAR GLOBAL
////////////////////////////////////////////////////////////

PreferredSizeWidget menuAppBar(BuildContext context) {
  final acess = context.watch<AccessibilityController>();

  return AppBar(
    backgroundColor: acess.darkMode ? const Color(0xFF1A2B4C) : Colors.white,

    foregroundColor: acess.darkMode ? Colors.white : const Color(0xFF161616),

    elevation: 0,

    title: Row(
      children: [
        Image.asset('assets/logo.png', height: 30),

        const SizedBox(width: 10),

        Text(
          "NEXA",
          style: TextStyle(
            color: acess.darkMode ? Colors.white : const Color(0xFF161616),
            fontWeight: FontWeight.bold,
          ),
        ),
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
        ////////////////////////////////////////////////////
        /// TEMA CLARO
        ////////////////////////////////////////////////////

        final ThemeData temaClaro = ThemeData(
          useMaterial3: true,
          brightness: Brightness.light,

          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF0F2A44),
            brightness: Brightness.light,
          ),

          scaffoldBackgroundColor: const Color(0xFFF3F5F9),

          appBarTheme: const AppBarTheme(
            backgroundColor: Colors.white,
            foregroundColor: Color(0xFF161616),
            elevation: 0,
          ),
        );

        ////////////////////////////////////////////////////
        /// TEMA ESCURO
        ////////////////////////////////////////////////////

        final ThemeData temaEscuro = ThemeData(
          useMaterial3: true,
          brightness: Brightness.dark,

          colorScheme: const ColorScheme.dark(
            primary: Color(0xFF0F62FE),
            secondary: Color(0xFF1A9DE7),
            surface: Colors.black,
            onSurface: Colors.white,
            onPrimary: Colors.white,
          ),

          scaffoldBackgroundColor: Colors.black,

          appBarTheme: const AppBarTheme(
            backgroundColor: Color(0xFF1A2B4C),
            foregroundColor: Colors.white,
            elevation: 0,
          ),

          cardTheme: const CardThemeData(color: Color(0xFF1A2B4C)),

          drawerTheme: const DrawerThemeData(
            backgroundColor: Color(0xFF1A2B4C),
          ),

          dialogTheme: const DialogThemeData(
            backgroundColor: Color(0xFF1A2B4C),
          ),
        );

        ////////////////////////////////////////////////////
        /// MATERIAL APP
        ////////////////////////////////////////////////////

        return MaterialApp(
          debugShowCheckedModeBanner: false,

          title: 'NEXA',

          //////////////////////////////////////////////////
          /// TEMA CLARO
          //////////////////////////////////////////////////
          theme: temaClaro,

          //////////////////////////////////////////////////
          /// TEMA ESCURO
          //////////////////////////////////////////////////
          darkTheme: temaEscuro,

          //////////////////////////////////////////////////
          /// ESCOLHA GLOBAL DO TEMA
          //////////////////////////////////////////////////
          themeMode: acess.darkMode ? ThemeMode.dark : ThemeMode.light,

          //////////////////////////////////////////////////
          /// ESCALA GLOBAL DA FONTE
          //////////////////////////////////////////////////
          builder: (context, child) {
            return MediaQuery(
              data: MediaQuery.of(
                context,
              ).copyWith(textScaler: TextScaler.linear(acess.fontSizeScale)),

              child: child ?? const SizedBox(),
            );
          },

          //////////////////////////////////////////////////
          /// PÁGINA INICIAL
          //////////////////////////////////////////////////
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
