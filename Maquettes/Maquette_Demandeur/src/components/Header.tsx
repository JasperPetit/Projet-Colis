import { LogOut } from 'lucide-react';

interface HeaderProps {
  onLogout: () => void;
}

export default function Header({ onLogout }: HeaderProps) {
  return (
    <header className="bg-white border-b border-gray-200 px-8 py-4">
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-4">
          <input
            type="text"
            placeholder="Identifiant universitaire"
            className="px-4 py-2 border border-gray-300 rounded w-64"
            disabled
            value="user@sorbonne-paris-nord.fr"
          />
        </div>
        <button
          onClick={onLogout}
          className="bg-[#f5b942] text-[#1e3a5f] px-6 py-2 rounded hover:bg-[#e5a932] transition-colors flex items-center gap-2"
        >
          <LogOut className="w-4 h-4" />
          Se déconnecter
        </button>
      </div>
    </header>
  );
}
