import { Package, ShoppingCart, CheckCircle, QrCode } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";

export function Dashboard() {
  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Suivi Colis</h1>
        <p className="text-muted-foreground">IUT de Villetaneuse</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <Card className="p-8 hover:shadow-lg transition-shadow">
          <div className="flex items-start justify-between mb-4">
            <h3 className="text-foreground">Colis en attente</h3>
            <div className="bg-primary/10 p-3 rounded-lg">
              <Package className="h-6 w-6 text-primary" />
            </div>
          </div>
          <div className="text-5xl text-[rgb(0,40,85)] mb-2">5</div>
        </Card>

        <Card className="p-8 hover:shadow-lg transition-shadow">
          <div className="flex items-start justify-between mb-4">
            <h3 className="text-foreground">Commandes en cours</h3>
            <div className="bg-primary/10 p-3 rounded-lg">
              <ShoppingCart className="h-6 w-6 text-primary" />
            </div>
          </div>
          <div className="text-5xl text-primary mb-2">3</div>
        </Card>
      </div>

      <Card className="p-8 mb-8 hover:shadow-lg transition-shadow">
        <div className="flex items-start justify-between mb-6">
          <h3 className="text-foreground">Dernier colis livré</h3>
          <div className="bg-primary/10 p-3 rounded-lg">
            <CheckCircle className="h-6 w-6 text-primary" />
          </div>
        </div>
        <div className="space-y-2">
          <p className="text-sm text-muted-foreground">Numéro de suivi</p>
          <p className="text-2xl text-primary">FR234567890AZERTY</p>
          <p className="text-sm text-muted-foreground mt-4">Livré le 15 Nov 2025</p>
        </div>
      </Card>

      <div className="flex gap-4">
        <Button className="bg-accent hover:bg-accent/90 text-accent-foreground px-8 py-6">
          Créer un bon de commande
        </Button>
        <Button 
          variant="outline" 
          className="border-2 border-primary text-primary hover:bg-primary/5 px-8 py-6"
        >
          <QrCode className="h-5 w-5 mr-2" />
          Scanner un colis
        </Button>
      </div>
    </div>
  );
}
