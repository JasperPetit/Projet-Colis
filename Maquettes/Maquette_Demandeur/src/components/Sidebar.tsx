import { LucideIcon } from 'lucide-react';
import { ImageWithFallback } from './figma/ImageWithFallback';
import logoImage from 'figma:asset/b52418cbda3a370222103149d55a48dd05633d3c.png';

interface NavigationItem {
  id: string;
  label: string;
  icon: LucideIcon;
}

interface SidebarProps {
  items: NavigationItem[];
  currentPage: string;
  onNavigate: (page: string) => void;
}

export default function Sidebar({ items, currentPage, onNavigate }: SidebarProps) {
  return (
    <aside className="w-64 bg-[#1e3a5f] text-white flex flex-col">
      <div className="p-6 border-b border-white/10">
        <div className="flex items-start gap-3">
          <div className="w-16 h-20 bg-white/20 rounded flex items-center justify-center flex-shrink-0">
            <ImageWithFallback src={logoImage} alt="Sorbonne Paris Nord" className="w-14 h-14 object-contain" />
          </div>
          <div className="leading-tight">
            <div className="text-sm">SORBONNE</div>
            <div className="text-sm">PARIS NORD</div>
          </div>
        </div>
      </div>
      <nav className="flex-1 p-4">
        {items.map((item) => {
          const Icon = item.icon;
          const isActive = currentPage === item.id;
          return (
            <button
              key={item.id}
              onClick={() => onNavigate(item.id)}
              className={`w-full flex items-center gap-3 px-4 py-3 rounded mb-2 transition-colors ${
                isActive
                  ? 'bg-white/20 text-white'
                  : 'text-white/80 hover:bg-white/10 hover:text-white'
              }`}
            >
              <Icon className="w-5 h-5" />
              <span>{item.label}</span>
            </button>
          );
        })}
      </nav>
    </aside>
  );
}
