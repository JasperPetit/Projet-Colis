import { Home, ShoppingCart, Package, Users, Settings, BookOpen } from "lucide-react";
import logo from "figma:asset/6bf3757771d296a4863699c1d11bb6d6a769a6ba.png";

interface SidebarProps {
  currentPage: string;
  onNavigate: (page: string) => void;
}

export function Sidebar({ currentPage, onNavigate }: SidebarProps) {
  const menuItems = [
    { id: "accueil", label: "Accueil", icon: Home },
    { id: "commandes", label: "Mes commandes", icon: ShoppingCart },
    { id: "colis", label: "Colis", icon: Package },
    { id: "fournisseurs", label: "Fournisseurs", icon: Users },
    { id: "administration", label: "Administration", icon: Settings },
    { id: "tutoriel", label: "Tutoriel", icon: BookOpen },
  ];

  return (
    <aside className="w-56 bg-primary min-h-screen p-6 flex flex-col">
      <div className="mb-12 px-2">
        <img src={logo} alt="Université Sorbonne Paris Nord" className="w-full h-auto rounded-lg" />
      </div>

      <nav className="flex-1">
        <ul className="space-y-2">
          {menuItems.map((item) => {
            const Icon = item.icon;
            const isActive = currentPage === item.id;
            return (
              <li key={item.id}>
                <button
                  onClick={() => onNavigate(item.id)}
                  className={`w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-colors ${
                    isActive
                      ? "bg-white/10 text-white"
                      : "text-white/80 hover:bg-white/5 hover:text-white"
                  }`}
                >
                  <Icon className="h-5 w-5" />
                  <span>{item.label}</span>
                </button>
              </li>
            );
          })}
        </ul>
      </nav>
    </aside>
  );
}
