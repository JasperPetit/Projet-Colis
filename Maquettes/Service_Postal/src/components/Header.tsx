import { Search, Bell, User } from 'lucide-react';

export function Header() {
  return (
    <header className="bg-[#1a3a5c] px-8 py-4">
      <div className="flex justify-end items-center">
        <div className="flex items-center gap-4">
          <div className="relative">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
            <input
              type="text"
              placeholder="Rechercher un colis par numéro..."
              className="pl-10 pr-4 py-2 rounded w-96 border-none outline-none bg-white/10 text-white placeholder:text-white/60"
            />
          </div>
          
          <button className="relative p-2 hover:bg-[#2d5273] rounded transition-colors">
            <Bell className="w-5 h-5 text-white" />
            <span className="absolute top-1 right-1 w-2 h-2 bg-[#f4b942] rounded-full"></span>
          </button>
          
          <button className="flex items-center gap-2 bg-[#f4b942] hover:bg-[#e5a832] text-[#1a3a5c] px-4 py-2 rounded transition-colors ml-auto">
            <User className="w-4 h-4" />
            <span>Agent Postal</span>
          </button>
        </div>
      </div>
    </header>
  );
}
