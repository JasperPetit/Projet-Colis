import { Package, Bell, User } from "lucide-react";
import { Button } from "./ui/button";

export function Header() {
  return (
    <header className="bg-primary text-primary-foreground shadow-md">
      <div className="container mx-auto px-4 py-4">
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-3">
            <div className="bg-white p-2 rounded-lg">
              <Package className="h-8 w-8 text-primary" />
            </div>
            <div>
              <h1 className="text-white">UniTrack</h1>
              <p className="text-blue-100 text-sm">Suivi de Colis Universitaire</p>
            </div>
          </div>
          
          <nav className="hidden md:flex items-center gap-6">
            <a href="#" className="text-white hover:text-blue-100 transition-colors">
              Accueil
            </a>
            <a href="#" className="text-white hover:text-blue-100 transition-colors">
              Mes Colis
            </a>
            <a href="#" className="text-white hover:text-blue-100 transition-colors">
              Aide
            </a>
          </nav>
          
          <div className="flex items-center gap-3">
            <Button variant="ghost" size="icon" className="text-white hover:bg-white/10">
              <Bell className="h-5 w-5" />
            </Button>
            <Button variant="ghost" size="icon" className="text-white hover:bg-white/10">
              <User className="h-5 w-5" />
            </Button>
          </div>
        </div>
      </div>
    </header>
  );
}
