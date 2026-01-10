import { Search, Filter, MapPin, Truck, CheckCircle, Package as PackageIcon, QrCode } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";
import { Input } from "../ui/input";
import { Badge } from "../ui/badge";

export function Colis() {
  const colis = [
    {
      id: "COL-2025-156",
      tracking: "TRK123456789",
      destination: "Bâtiment A - Bureau 201",
      statut: "Livré",
      date: "12 Oct 2025 - 14:30",
      couleurStatut: "bg-green-500",
      icon: CheckCircle
    },
    {
      id: "COL-2025-157",
      tracking: "TRK987654321",
      destination: "Bâtiment B - Salle 105",
      statut: "En livraison",
      date: "12 Oct 2025 - 09:15",
      couleurStatut: "bg-blue-500",
      icon: Truck
    },
    {
      id: "COL-2025-158",
      tracking: "TRK456789123",
      destination: "Secrétariat Général",
      statut: "En attente",
      date: "11 Oct 2025 - 18:45",
      couleurStatut: "bg-yellow-500",
      icon: MapPin
    },
    {
      id: "COL-2025-159",
      tracking: "TRK789123456",
      destination: "Bibliothèque Universitaire",
      statut: "En transit",
      date: "11 Oct 2025 - 12:00",
      couleurStatut: "bg-orange-500",
      icon: Truck
    },
    {
      id: "COL-2025-160",
      tracking: "TRK321654987",
      destination: "Laboratoire de Recherche",
      statut: "Livré",
      date: "10 Oct 2025 - 16:20",
      couleurStatut: "bg-green-500",
      icon: CheckCircle
    },
  ];

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Gestion des Colis</h1>
        <p className="text-muted-foreground">Suivez et gérez tous vos colis en temps réel</p>
      </div>

      <div className="flex gap-4 mb-6">
        <div className="flex-1 relative">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground" />
          <Input 
            placeholder="Rechercher par numéro de suivi, destinataire..." 
            className="pl-10 border border-border"
          />
        </div>
        <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
          <Filter className="h-5 w-5 mr-2" />
          Filtrer
        </Button>
        <Button className="bg-accent hover:bg-accent/90 text-accent-foreground">
          <QrCode className="h-5 w-5 mr-2" />
          Scanner un colis
        </Button>
      </div>

      <div className="grid gap-4">
        {colis.map((c) => {
          const Icon = c.icon;
          return (
            <Card key={c.id} className="p-6 hover:shadow-lg transition-shadow">
              <div className="flex items-center justify-between">
                <div className="flex items-center gap-6">
                  <div className="bg-primary/10 p-4 rounded-lg">
                    <PackageIcon className="h-6 w-6 text-primary" />
                  </div>
                  <div>
                    <div className="flex items-center gap-3 mb-1">
                      <h3 className="text-foreground">{c.id}</h3>
                      <span className="text-sm text-muted-foreground">• {c.tracking}</span>
                    </div>
                    <div className="flex items-center gap-4 text-sm text-muted-foreground">
                      <div className="flex items-center gap-1">
                        <MapPin className="h-4 w-4" />
                        <span>{c.destination}</span>
                      </div>
                      <div className="flex items-center gap-1">
                        <Icon className="h-4 w-4" />
                        <span>{c.date}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="flex items-center gap-4">
                  <Badge className={`${c.couleurStatut} text-white`}>
                    {c.statut}
                  </Badge>
                  <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
                    Suivre
                  </Button>
                </div>
              </div>
            </Card>
          );
        })}
      </div>
    </div>
  );
}
