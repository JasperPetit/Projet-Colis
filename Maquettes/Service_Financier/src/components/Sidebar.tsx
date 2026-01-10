import { LayoutDashboard, CreditCard, FileText, BarChart3, Package, Wallet } from 'lucide-react';

interface SidebarProps {
  currentPage: string;
  onPageChange: (page: string) => void;
}

export function Sidebar({ currentPage, onPageChange }: SidebarProps) {
  const menuItems = [
    { id: 'dashboard', label: 'Tableau de bord', icon: LayoutDashboard },
    { id: 'transactions', label: 'Transactions', icon: CreditCard },
    { id: 'invoices', label: 'Factures', icon: FileText },
    { id: 'reports', label: 'Rapports', icon: BarChart3 },
  ];

  return (
    <aside className="w-64 bg-[#00205B] text-white min-h-[calc(100vh-80px)]">
      <nav className="p-4">
        <ul className="space-y-2">
          {menuItems.map((item) => {
            const Icon = item.icon;
            return (
              <li key={item.id}>
                <button
                  onClick={() => onPageChange(item.id)}
                  className={`w-full flex items-center gap-3 px-4 py-3 rounded transition-colors ${
                    currentPage === item.id
                      ? 'bg-[#2d5380]'
                      : 'hover:bg-[#2d5380]'
                  }`}
                >
                  <Icon size={20} />
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
