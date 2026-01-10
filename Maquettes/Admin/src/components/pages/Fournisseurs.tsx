import { Search, Plus, Mail, Phone, MapPin, Star } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";
import { Input } from "../ui/input";
import { Badge } from "../ui/badge";

export function Fournisseurs() {
  const fournisseurs = [
    {
      id: "1",
      nom: "Librairie Académique Dupont",
      categorie: "Livres & Fournitures",
      email: "contact@dupont-livres.fr",
      telephone: "01 23 45 67 89",
      adresse: "12 Rue de la République, 93430 Villetaneuse",
      commandes: 45,
      note: 4.8
    },
    {
      id: "2",
      nom: "Matériel Lab Pro",
      categorie: "Équipements Scientifiques",
      email: "ventes@labpro.fr",
      telephone: "01 34 56 78 90",
      adresse: "8 Avenue des Sciences, 75013 Paris",
      commandes: 32,
      note: 4.5
    },
    {
      id: "3",
      nom: "Bureau Plus Université",
      categorie: "Mobilier & Bureautique",
      email: "info@bureauplus.fr",
      telephone: "01 45 67 89 01",
      adresse: "25 Boulevard Universitaire, 93200 Saint-Denis",
      commandes: 28,
      note: 4.7
    },
    {
      id: "4",
      nom: "Tech Campus Solutions",
      categorie: "Informatique & Électronique",
      email: "support@techcampus.fr",
      telephone: "01 56 78 90 12",
      adresse: "15 Rue de l'Innovation, 92000 Nanterre",
      commandes: 38,
      note: 4.9
    },
  ];

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Fournisseurs</h1>
        <p className="text-muted-foreground">Gérez vos fournisseurs et partenaires</p>
      </div>

      <div className="flex gap-4 mb-6">
        <div className="flex-1 relative">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-muted-foreground" />
          <Input 
            placeholder="Rechercher un fournisseur..." 
            className="pl-10 border border-border"
          />
        </div>
        <Button className="bg-accent hover:bg-accent/90 text-accent-foreground">
          <Plus className="h-5 w-5 mr-2" />
          Ajouter un fournisseur
        </Button>
      </div>

      <div className="grid md:grid-cols-2 gap-6">
        {fournisseurs.map((fournisseur) => (
          <Card key={fournisseur.id} className="p-6 hover:shadow-lg transition-shadow">
            <div className="flex items-start justify-between mb-4">
              <div>
                <h3 className="text-foreground mb-1">{fournisseur.nom}</h3>
                <Badge variant="outline" className="border-primary text-primary">
                  {fournisseur.categorie}
                </Badge>
              </div>
              <div className="flex items-center gap-1 text-yellow-500">
                <Star className="h-4 w-4 fill-current" />
                <span className="text-sm">{fournisseur.note}</span>
              </div>
            </div>

            <div className="space-y-3 mb-4">
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <Mail className="h-4 w-4" />
                <span>{fournisseur.email}</span>
              </div>
              <div className="flex items-center gap-2 text-sm text-muted-foreground">
                <Phone className="h-4 w-4" />
                <span>{fournisseur.telephone}</span>
              </div>
              <div className="flex items-start gap-2 text-sm text-muted-foreground">
                <MapPin className="h-4 w-4 mt-0.5" />
                <span>{fournisseur.adresse}</span>
              </div>
            </div>

            <div className="flex items-center justify-between pt-4 border-t border-border">
              <span className="text-sm text-muted-foreground">
                {fournisseur.commandes} commandes passées
              </span>
              <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
                Contacter
              </Button>
            </div>
          </Card>
        ))}
      </div>
    </div>
  );
}
