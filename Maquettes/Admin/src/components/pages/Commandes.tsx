import { Search, Plus, Calendar, Package, User } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";
import { Input } from "../ui/input";
import { Badge } from "../ui/badge";

export function Commandes() {
  const commandes = [
    {
      id: "CMD-2025-001",
      date: "10 Oct 2025",
      destinataire: "Jean Dupont",
      articles: 3,
      nombreColis: 2,
      statut: "En cours",
      couleurStatut: "bg-blue-500"
    },
    {
      id: "CMD-2025-002",
      date: "09 Oct 2025",
      destinataire: "Marie Martin",
      articles: 5,
      nombreColis: 3,
      statut: "Validée",
      couleurStatut: "bg-green-500"
    },
    {
      id: "CMD-2025-003",
      date: "08 Oct 2025",
      destinataire: "Pierre Bernard",
      articles: 2,
      nombreColis: 1,
      statut: "En attente",
      couleurStatut: "bg-yellow-500"
    },
    {
      id: "CMD-2025-004",
      date: "07 Oct 2025",
      destinataire: "Sophie Dubois",
      articles: 4,
      nombreColis: 2,
      statut: "Livrée",
      couleurStatut: "bg-gray-500"
    },
  ];

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Mes Commandes</h1>
        <p className="text-muted-foreground">Gérez et suivez toutes vos commandes</p>
      </div>

      <div className="flex gap-4 mb-6">
        <div className="flex-1 relative">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground" />
          <Input 
            placeholder="Rechercher une commande..." 
            className="pl-10 border border-border"
          />
        </div>
        <Button className="bg-accent hover:bg-accent/90 text-accent-foreground">
          <Plus className="h-5 w-5 mr-2" />
          Nouvelle commande
        </Button>
      </div>

      <div className="grid gap-4">
        {commandes.map((commande) => (
          <Card key={commande.id} className="p-6 hover:shadow-lg transition-shadow">
            <div className="flex items-center justify-between">
              <div className="flex items-center gap-6">
                <div className="bg-primary/10 p-4 rounded-lg">
                  <Package className="h-6 w-6 text-primary" />
                </div>
                <div>
                  <h3 className="text-foreground mb-1">{commande.id}</h3>
                  <div className="flex items-center gap-4 text-sm text-muted-foreground">
                    <div className="flex items-center gap-1">
                      <Calendar className="h-4 w-4" />
                      <span>{commande.date}</span>
                    </div>
                    <div className="flex items-center gap-1">
                      <User className="h-4 w-4" />
                      <span>{commande.destinataire}</span>
                    </div>
                    <div className="flex items-center gap-1">
                      <Package className="h-4 w-4" />
                      <span>{commande.articles} article{commande.articles > 1 ? 's' : ''}</span>
                    </div>
                    <div className="flex items-center gap-1">
                      <Package className="h-4 w-4" />
                      <span>{commande.nombreColis} colis</span>
                    </div>
                  </div>
                </div>
              </div>
              <div className="flex items-center gap-4">
                <Badge className={`${commande.couleurStatut} text-white`}>
                  {commande.statut}
                </Badge>
                <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
                  Voir détails
                </Button>
              </div>
            </div>
          </Card>
        ))}
      </div>
    </div>
  );
}
