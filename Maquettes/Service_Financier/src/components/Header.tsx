import logoImg from 'figma:asset/b52418cbda3a370222103149d55a48dd05633d3c.png';
import { User } from 'lucide-react';

export function Header() {
  return (
    <header className="bg-[#00205B] text-white shadow-lg">
      <div className="flex items-center justify-between px-8 py-4">
        <div className="flex items-center gap-3">
          <img src={logoImg} alt="Sorbonne Paris Nord" className="h-20" />
        </div>
        <div className="flex items-center gap-4">
          <input
            type="text"
            placeholder="Identifiant utilisateur"
            className="px-4 py-2 rounded bg-white text-gray-800 placeholder-gray-500"
          />
          <button className="px-6 py-2 bg-[#f5b342] text-[#00205B] rounded hover:bg-[#f5c663] transition-colors">
            Se connecter
          </button>
        </div>
      </div>
    </header>
  );
}
