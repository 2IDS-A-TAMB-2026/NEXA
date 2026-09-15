import 'package:flutter/material.dart';

import '../views/profile_page.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';



class AppRoutes {
  static final Map<String, WidgetBuilder> routes = {
    '/dashboard_page_fun': (_) => const DashboardPageFun(),
    '/perfil': (_) => const PerfilPage(),
  };
}