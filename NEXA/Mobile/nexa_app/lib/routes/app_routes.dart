import 'package:flutter/material.dart';
import 'package:nexa_app/views/gerenciamento.epi.dart';

import '../views/register_page.dart';
import '../views/profile_page.dart';
import '../views/cameras_page.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';



class AppRoutes {
  static final Map<String, WidgetBuilder> routes = {
    '/register': (_) => const RegisterPage(),
    '/dashboard_page_fun': (_) => const DashboardPageFun(),
    '/perfil': (_) => const PerfilPage(),
    '/epis': (_) => const CadastroEPIPage(),
    '/cameras': (_) => const CamerasPage(),
  };
}