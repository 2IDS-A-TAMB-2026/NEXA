import 'package:flutter/material.dart';
import 'package:nexa_app/views/dashboard_page.dart';
import 'package:nexa_app/views/login_page.dart';


void main() {
  runApp(const MainApp());
}

////////////////////////////////////////////////////////////
/// MODELO DE USUÁRIO
////////////////////////////////////////////////////////////

class Usuario {
  String nome;
  String email;
  String senha;
  String foto;
  String telefone;
  String cpf;
  String dataNascimento;
  String tipoPerfil;
  String uidRfid;
  String epis;

  Usuario({
    required this.nome,
    required this.email,
    required this.senha,
    required this.foto,
    required this.telefone,
    required this.cpf,
    required this.dataNascimento,
    required this.tipoPerfil,
    required this.uidRfid,
    required this.epis,
  });
}

Usuario usuarioLogado = Usuario(
  nome: "Administrador NEXA",
  email: "admin@nexa.com",
  senha: "123456",
  foto: "assets/admin.png",
  telefone: "(19) 99999-9999",
  cpf: "000.000.000-00",
  dataNascimento: "01/01/1990",
  tipoPerfil: "Administrador",
  uidRfid: "RFID-984523",
  epis: "Capacete, Luva, Óculos",
);

////////////////////////////////////////////////////////////
/// APP
////////////////////////////////////////////////////////////

class MainApp extends StatefulWidget {
  const MainApp({super.key});

  @override
  State<MainApp> createState() => _MainAppState();
}

class _MainAppState extends State<MainApp> {
  bool logado = false;
  bool mostrarInstitucional = true;

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: mostrarInstitucional
          ? InstitucionalPage(
              onIrParaLogin: () {
                setState(() {
                  mostrarInstitucional = false;
                });
              },
            )
          : logado
          ? Dashboard(
              onLogout: () {
                setState(() {
                  logado = false;
                  mostrarInstitucional = true;
                });
              },
            )
          : LoginPage(
              onLogin: () {
                setState(() {
                  logado = true;
                });
              },
              onVoltar: () {
                setState(() {
                  mostrarInstitucional = true;
                });
              },
            ),
    );
  }
}
////////////////////////////////////////////////////////////
/// PÁGINA INSTITUCIONAL
////////////////////////////////////////////////////////////

class InstitucionalPage extends StatelessWidget {
  final VoidCallback onIrParaLogin;

  const InstitucionalPage({super.key, required this.onIrParaLogin});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 249, 249, 250),
      appBar: AppBar(
        backgroundColor: const Color.fromARGB(255, 248, 249, 250),
        automaticallyImplyLeading: false,
        shadowColor: const Color.fromARGB(255, 36, 10, 10),
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 15),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [

                 TextButton(
                onPressed: () {
                 Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const SobrePage()),
              );
            },
            child: const Text("Sobre nós"),
          ),



          
          TextButton(
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const SolucoesPage()),
              );
            },
            child: const Text("Soluções"),
          ),


            TextButton(
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const ValoresPage()),
              );
            },
            child: const Text("Valores"),
          ),

                
                TextButton(
                  onPressed: onIrParaLogin,
                  child: const Text("Cadastre-se"),
                ),
                
                        ],
                      ),
                    ),
                  ],
                ),

      body: Padding(
        padding: EdgeInsets.all(40),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              RichText(
                text: TextSpan(
                  children: [
                    TextSpan(
                      text: 'Safety at the',
                      style: TextStyle(color: Colors.black, fontSize: 70),
                    ),
                    TextSpan(
                      text: ' Core',
                      style: TextStyle(
                        color: Color.fromARGB(255, 109, 176, 237),
                        fontSize: 70,
                      ),
                    ),
                  ],
                ),
              ),

              SizedBox(height: 20),
              Text(
                "A NEXA é uma plataforma inteligente de segurança do trabalho, unindo tecnologia, dados e automação para proteger pessoas e operações.",
              ),
              
         

           

              


              
            ],
          ),
        ),
      ),
    );
  }
}

////////////////////////////////////////////////////////////
/// LOGIN
////////////////////////////////////////////////////////////

class LoginPage extends StatelessWidget {
  final VoidCallback onLogin;
  final VoidCallback onVoltar;

  const LoginPage({super.key, required this.onLogin, required this.onVoltar});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6FA),
      body: Center(
        child: Container(
          width: 400,
          padding: const EdgeInsets.all(30),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: const [BoxShadow(color: Colors.black12, blurRadius: 10)],
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Align(
                alignment: Alignment.centerLeft,
                child: TextButton.icon(
                  onPressed: onVoltar,
                  icon: const Icon(Icons.undo, color: Color(0xFF0A66C2)),
                  label: const Text(
                    "Voltar",
                    style: TextStyle(color: Color.fromARGB(255, 0, 0, 0)),
                  ),
                ),
              ),
              Image.asset("assets/logo.png", height: 80),
              const SizedBox(height: 20),
              const Text(
                "Bem-vindo ao NEXA",
                style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 25),
              const TextField(
                decoration: InputDecoration(
                  labelText: "E-mail",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 15),
              const TextField(
                obscureText: true,
                decoration: InputDecoration(
                  labelText: "Senha",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: onLogin,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF0A66C2),
                  minimumSize: const Size(double.infinity, 45),
                ),
                child: const Text(
                  "Entrar",
                  style: TextStyle(color: Colors.white),
                ),
              ),
              const SizedBox(height: 10),
              TextButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (_) => const CadastroPage()),
                  );
                },
                child: const Text(
                  "Criar conta",
                  style: TextStyle(color: Color.fromARGB(255, 14, 14, 14)),
                ),
              ),
              const SizedBox(height: 10),

              TextButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => const RecuperarSenhaPage(),
                    ),
                  );
                },
                child: const Text(
                  "Esqueci a senha",
                  style: TextStyle(color: Color.fromARGB(255, 13, 13, 13)),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

////////////////////////////////////////////////////////////
/// RECUPERAÇÃO DE SENHA
////////////////////////////////////////////////////////////

class RecuperarSenhaPage extends StatefulWidget {
  const RecuperarSenhaPage({super.key});

  @override
  State<RecuperarSenhaPage> createState() => _RecuperarSenhaPageState();
}

class _RecuperarSenhaPageState extends State<RecuperarSenhaPage> {
  final emailController = TextEditingController();
  String mensagem = "";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6FA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF15114B),
        iconTheme: const IconThemeData(color: Colors.white),
        title: const Text(
          "Recuperar Senha",
          style: TextStyle(color: Color.fromARGB(255, 224, 221, 221)),
        ),
      ),
      body: Center(
        child: Container(
          width: 400,
          padding: const EdgeInsets.all(30),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: const [BoxShadow(color: Colors.black12, blurRadius: 10)],
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              const Text(
                "Informe o e-mail cadastrado",
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 20),
              TextField(
                controller: emailController,
                decoration: const InputDecoration(
                  labelText: "E-mail",
                  border: OutlineInputBorder(),
                ),
              ),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  if (emailController.text == usuarioLogado.email) {
                    setState(() {
                      mensagem = "Instruções enviadas para o e-mail.";
                    });
                  } else {
                    setState(() {
                      mensagem = "E-mail não encontrado.";
                    });
                  }
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF15114B),
                  minimumSize: const Size(double.infinity, 45),
                ),
                child: const Text(
                  "Enviar",
                  style: TextStyle(color: Colors.white),
                ),
              ),
              const SizedBox(height: 15),
              Text(mensagem, style: const TextStyle(color: Colors.red)),
            ],
          ),
        ),
      ),
    );
  }
}

////////////////////////////////////////////////////////////
/// CADASTRO ATUALIZADO
////////////////////////////////////////////////////////////

class CadastroPage extends StatefulWidget {
  const CadastroPage({super.key});

  @override
  State<CadastroPage> createState() => _CadastroPageState();
}

class _CadastroPageState extends State<CadastroPage> {
  String tipoUsuario = "Funcionário";

  final nomeController = TextEditingController();
  final cpfController = TextEditingController();
  final nascimentoController = TextEditingController();
  final emailController = TextEditingController();
  final telefoneController = TextEditingController();
  final senhaController = TextEditingController();
  final confirmarSenhaController = TextEditingController();

  final codigoEmpresaController = TextEditingController();
  final rfidController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6FA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF0F2A44),
        iconTheme: const IconThemeData(color: Colors.white),
        title: const Text("Cadastro", style: TextStyle(color: Colors.white)),
      ),
      body: Center(
        child: Container(
          width: 500,
          padding: const EdgeInsets.all(30),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: const [BoxShadow(color: Colors.black12, blurRadius: 10)],
          ),
          child: SingleChildScrollView(
            child: Column(
              children: [
                const Text(
                  "Criar Conta",
                  style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold),
                ),

                const SizedBox(height: 20),

                DropdownButtonFormField<String>(
                  value: tipoUsuario,
                  decoration: const InputDecoration(
                    labelText: "Tipo de usuário",
                    border: OutlineInputBorder(),
                  ),
                  items: const [
                    DropdownMenuItem(
                      value: "Funcionário",
                      child: Text("Funcionário"),
                    ),
                    DropdownMenuItem(
                      value: "Administrador",
                      child: Text("Administrador"),
                    ),
                  ],
                  onChanged: (value) {
                    setState(() {
                      tipoUsuario = value!;
                    });
                  },
                ),

                const SizedBox(height: 15),

                campo("Nome completo", nomeController),
                campo("CPF", cpfController),
                campo("Data de nascimento", nascimentoController),
                campo("E-mail corporativo", emailController),
                campo("Telefone", telefoneController),
                campo("Senha", senhaController, oculto: true),
                campo(
                  "Confirmação de senha",
                  confirmarSenhaController,
                  oculto: true,
                ),

                const SizedBox(height: 20),

                ElevatedButton(
                  onPressed: () {
                    if (senhaController.text != confirmarSenhaController.text) {
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text("As senhas não conferem."),
                        ),
                      );
                      return;
                    }

                    usuarioLogado.nome = nomeController.text;
                    usuarioLogado.email = emailController.text;
                    usuarioLogado.senha = senhaController.text;

                    Navigator.pop(context);
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF0A66C2),
                    minimumSize: const Size(double.infinity, 45),
                  ),
                  child: const Text(
                    "Cadastrar",
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: TextField(
        controller: controller,
        obscureText: oculto,
        decoration: InputDecoration(
          labelText: label,
          border: const OutlineInputBorder(),
        ),
      ),
    );
  }
}


//VALORES
class ValoresPage extends StatelessWidget {
  const ValoresPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Valores")),
      body: const Padding(
        padding: EdgeInsets.all(20),
        child: Text(
          "Nossos valores são baseados no compromisso com a segurança, a inovação e a excelência em tudo o que entregamos. Acreditamos que a tecnologia deve ser uma aliada na proteção das pessoas, por isso colocamos a integridade e o bem-estar dos usuários no centro de nossas decisões. \n Prezamos pela transparência e ética em cada relacionamento, construindo parcerias sólidas e de confiança com nossos clientes. Valorizamos a responsabilidade, garantindo que nossas soluções sejam confiáveis, eficientes e alinhadas às necessidades reais do mercado. \n A inovação contínua também é um dos nossos pilares, buscando sempre evoluir e incorporar novas tecnologias que agreguem valor à nossa plataforma. Além disso, incentivamos a colaboração e o comprometimento, tanto dentro da nossa equipe quanto com nossos clientes, para alcançar resultados cada vez melhores. \n Nosso propósito é gerar impacto positivo, promovendo ambientes de trabalho mais seguros, organizados e preparados para o futuro.",
        ),
      ),
    );
  }
}




//SOLUÇÕES

class SolucoesPage extends StatelessWidget {
  const SolucoesPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Soluções")),
      body: const Padding(
        padding: EdgeInsets.all(20),
        child: Text(
          "Nossa solução foi desenvolvida para oferecer uma gestão completa, eficiente e inteligente da segurança no ambiente de trabalho. Por meio de uma plataforma moderna e intuitiva, integramos tecnologias que permitem o monitoramento contínuo de operações, garantindo maior controle e prevenção de riscos.\n O sistema possibilita o cadastro e gerenciamento de colaboradores, equipamentos de proteção individual (EPIs) e câmeras de segurança, centralizando todas as informações em um único ambiente digital. Além disso, fornecemos recursos que facilitam a tomada de decisão, como visualização de dados em tempo real e organização estratégica das informações. \n Pensando na experiência do usuário, a plataforma foi projetada com foco em usabilidade, permitindo fácil navegação e acesso rápido às funcionalidades essenciais. Dessa forma, nossos clientes conseguem otimizar processos internos, aumentar a produtividade e reforçar a cultura de segurança dentro da empresa. \n Nosso objetivo é não apenas atender às necessidades atuais, mas também oferecer uma solução escalável, que acompanhe o crescimento e as demandas futuras de cada cliente, garantindo inovação, confiabilidade e excelência em cada etapa.",
        ),
      ),
    );
  }
}

//SOBRE NÓS

class SobrePage extends StatelessWidget {
  const SobrePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Sobre nós")),
        body: Padding(
    padding: EdgeInsets.all(20),
    child: Column(
      children: [
        Text("Somos uma equipe dedicada ao desenvolvimento de soluções tecnológicas voltadas para a segurança e gestão no ambiente de trabalho. Unimos conhecimento, inovação e compromisso para criar uma plataforma que realmente faça a diferença no dia a dia das empresas.
Nosso foco está em simplificar processos, aumentar a eficiência e garantir maior controle das operações, sempre priorizando a proteção das pessoas. Trabalhamos com responsabilidade e atenção aos detalhes, buscando entregar um sistema confiável, intuitivo e alinhado às necessidades de cada cliente.
Acreditamos que a tecnologia, quando bem aplicada, transforma realidades. Por isso, estamos em constante evolução, aprimorando nossas ferramentas e acompanhando as mudanças do mercado para oferecer sempre o melhor.
Mais do que uma solução, somos parceiros dos nossos clientes na construção de ambientes mais seguros, organizados e preparados para os desafios do futuro."),

        Text("Full Stack"),
        SizedBox(height: 30),

        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            CircleAvatar(
              radius: 30,
              backgroundImage: AssetImage('assets/bruno.jpg'),
            ),
            SizedBox(width: 10),
            CircleAvatar(
              radius: 30,
              backgroundImage: AssetImage('assets/livia.jpg'),
            ),
          ],
        ),

              Text("Back-end"),
              SizedBox(height: 30),

              Row(
                mainAxisAlignment: MainAxisAlignment.center, // Centraliza as fotos
                children: [
                  CircleAvatar(
                    radius: 30, // Tamanho do círculo
                    backgroundImage: AssetImage('assets/nicoly.png'), // Ou NetworkImage
                  ),
                  SizedBox(width: 10), // Espaçamento entre as fotos
                  CircleAvatar(
                    radius: 30,
                    backgroundImage: AssetImage('assets/erick.png'),
                  ),
                  SizedBox(width: 10),
                  CircleAvatar(
                    radius: 30,
                    backgroundImage: AssetImage('assets/fernanda.png'),
                  ),
                ],
              ),

              //Front
              Text(
                "Front-end",
              ),
              SizedBox(height: 30),
              
              Row(
                mainAxisAlignment: MainAxisAlignment.center, // Centraliza as fotos
                children: [
                  CircleAvatar(
                    radius: 30, // Tamanho do círculo
                    backgroundImage: AssetImage('assets/laura.jpeg'), // Ou NetworkImage
                  ),
                  SizedBox(width: 10), // Espaçamento entre as fotos
                  CircleAvatar(
                    radius: 30,
                    backgroundImage: AssetImage('assets/ryan.png'),
                  ),
                ],
              ),
            ],
          ),
        ),
      );
    }
  }
    