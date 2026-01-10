import { Home, ScanLine, Package, Send, FileText, Archive, Settings, TrendingUp } from 'lucide-react';
import logo from 'figma:asset/b52418cbda3a370222103149d55a48dd05633d3c.png';

interface SidebarProps {
  currentView: string;
  setCurrentView: (view: 'dashboard' | 'scanner' | 'tracking' | 'new-shipment') => void;
}

export function Sidebar({ currentView, setCurrentView }: SidebarProps) {
  const menuItems = [
    { icon: Home, label: 'Tableau de bord', view: 'dashboard' as const },
    { icon: ScanLine, label: 'Scanner un colis', view: 'scanner' as const },
    { icon: Send, label: 'Nouvel envoi', view: 'new-shipment' as const },
    { icon: Package, label: 'Suivi des colis', view: 'tracking' as const },
  ];

  const secondaryItems = [
    { icon: Archive, label: 'Archives' },
    { icon: FileText, label: 'Rapports' },
    { icon: TrendingUp, label: 'Statistiques' },
    { icon: Settings, label: 'Paramètres' },
  ];

  return (
    <aside className="w-72 bg-[#1a3a5c] text-white p-6">
      <div className="mb-8 pb-6 border-b border-white/20">
        <img src={logo} alt="Sorbonne Paris Nord" className="h-20 w-auto mb-3" />
        <div className="text-white">
          <div className="font-semibold">Service Postal</div>
          <div className="text-xs opacity-75">Gestion et suivi des envois</div>
        </div>
      </div>
      
      <div className="space-y-2 mb-8">
        {menuItems.map((item, index) => (
          <button
            key={index}
            onClick={() => setCurrentView(item.view)}
            className={`w-full flex items-center gap-3 px-4 py-3 rounded transition-colors ${
              currentView === item.view
                ? 'bg-[#f4b942] text-[#1a3a5c]'
                : 'hover:bg-[#2d5273] text-gray-300'
            }`}
          >
            <item.icon className="w-5 h-5" />
            <span>{item.label}</span>
          </button>
        ))}
      </div>

      <div className="border-t border-gray-600 pt-6">
        <p className="text-xs text-gray-400 uppercase tracking-wider mb-4 px-4">Gestion</p>
        <div className="space-y-2">
          {secondaryItems.map((item, index) => (
            <button
              key={index}
              className="w-full flex items-center gap-3 px-4 py-3 rounded hover:bg-[#2d5273] text-gray-300 transition-colors"
            >
              <item.icon className="w-5 h-5" />
              <span>{item.label}</span>
            </button>
          ))}
        </div>
      </div>
    </aside>
  );
}
