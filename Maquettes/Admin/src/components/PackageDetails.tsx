import { Package, Calendar, MapPin, User, Weight } from "lucide-react";
import { Card } from "./ui/card";

export function PackageDetails() {
  return (
    <Card className="p-6 shadow-lg">
      <h3 className="text-primary mb-6">Détails du colis</h3>
      
      <div className="space-y-4">
        <div className="flex items-start gap-3">
          <div className="bg-secondary p-2 rounded-lg">
            <Package className="h-5 w-5 text-primary" />
          </div>
          <div className="flex-1">
            <p className="text-muted-foreground text-sm">Type de colis</p>
            <p>Livres académiques</p>
          </div>
        </div>

        <div className="flex items-start gap-3">
          <div className="bg-secondary p-2 rounded-lg">
            <Weight className="h-5 w-5 text-primary" />
          </div>
          <div className="flex-1">
            <p className="text-muted-foreground text-sm">Poids</p>
            <p>2.5 kg</p>
          </div>
        </div>

        <div className="flex items-start gap-3">
          <div className="bg-secondary p-2 rounded-lg">
            <User className="h-5 w-5 text-primary" />
          </div>
          <div className="flex-1">
            <p className="text-muted-foreground text-sm">Destinataire</p>
            <p>Jean Dupont</p>
            <p className="text-sm text-muted-foreground">Étudiant - Faculté des Sciences</p>
          </div>
        </div>

        <div className="flex items-start gap-3">
          <div className="bg-secondary p-2 rounded-lg">
            <MapPin className="h-5 w-5 text-primary" />
          </div>
          <div className="flex-1">
            <p className="text-muted-foreground text-sm">Adresse de livraison</p>
            <p>Bureau de poste universitaire</p>
            <p className="text-sm text-muted-foreground">Bâtiment A, Campus Principal</p>
          </div>
        </div>

        <div className="flex items-start gap-3">
          <div className="bg-secondary p-2 rounded-lg">
            <Calendar className="h-5 w-5 text-primary" />
          </div>
          <div className="flex-1">
            <p className="text-muted-foreground text-sm">Date d'expédition</p>
            <p>9 Octobre 2025</p>
          </div>
        </div>
      </div>

      <div className="mt-6 p-4 bg-blue-50 border-l-4 border-primary rounded">
        <p className="text-sm">
          <span className="text-primary">Note:</span> Votre colis est disponible pour retrait. 
          Veuillez apporter votre carte d'étudiant et une pièce d'identité.
        </p>
      </div>
    </Card>
  );
}
