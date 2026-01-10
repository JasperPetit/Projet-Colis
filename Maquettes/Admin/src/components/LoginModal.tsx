import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "./ui/dialog";
import { Input } from "./ui/input";
import { Button } from "./ui/button";
import { Label } from "./ui/label";
import { User, Lock } from "lucide-react";

interface LoginModalProps {
  open: boolean;
  onOpenChange: (open: boolean) => void;
}

export function LoginModal({ open, onOpenChange }: LoginModalProps) {
  const [identifiant, setIdentifiant] = useState("");
  const [motDePasse, setMotDePasse] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // Logique de connexion ici
    console.log("Connexion:", { identifiant, motDePasse });
    onOpenChange(false);
  };

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="sm:max-w-md">
        <DialogHeader>
          <DialogTitle className="text-primary text-center">Connexion</DialogTitle>
        </DialogHeader>
        <form onSubmit={handleSubmit} className="space-y-6 mt-4">
          <div className="space-y-2">
            <Label htmlFor="identifiant">Identifiant universitaire</Label>
            <div className="relative">
              <User className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground" />
              <Input
                id="identifiant"
                type="text"
                placeholder="Entrez votre identifiant"
                value={identifiant}
                onChange={(e) => setIdentifiant(e.target.value)}
                className="pl-10 border border-border"
                required
              />
            </div>
          </div>

          <div className="space-y-2">
            <Label htmlFor="motdepasse">Mot de passe</Label>
            <div className="relative">
              <Lock className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground" />
              <Input
                id="motdepasse"
                type="password"
                placeholder="Entrez votre mot de passe"
                value={motDePasse}
                onChange={(e) => setMotDePasse(e.target.value)}
                className="pl-10 border border-border"
                required
              />
            </div>
          </div>

          <div className="flex items-center justify-between">
            <label className="flex items-center gap-2 text-sm">
              <input type="checkbox" className="rounded border-border" />
              <span className="text-muted-foreground">Se souvenir de moi</span>
            </label>
            <a href="#" className="text-sm text-primary hover:underline">
              Mot de passe oublié ?
            </a>
          </div>

          <Button
            type="submit"
            className="w-full bg-accent hover:bg-accent/90 text-accent-foreground"
          >
            Se connecter
          </Button>

          <div className="text-center text-sm text-muted-foreground">
            Besoin d'aide ? <a href="#" className="text-primary hover:underline">Contactez le support</a>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  );
}
