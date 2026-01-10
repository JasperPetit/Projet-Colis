import { Search } from "lucide-react";
import { Input } from "./ui/input";
import { Button } from "./ui/button";
import { Card } from "./ui/card";

interface TrackingSearchProps {
  onSearch: (trackingNumber: string) => void;
}

export function TrackingSearch({ onSearch }: TrackingSearchProps) {
  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const trackingNumber = formData.get("trackingNumber") as string;
    if (trackingNumber) {
      onSearch(trackingNumber);
    }
  };

  return (
    <Card className="p-8 shadow-lg">
      <div className="text-center mb-6">
        <h2 className="text-primary mb-2">Suivez votre colis</h2>
        <p className="text-muted-foreground">
          Entrez votre numéro de suivi pour voir où se trouve votre colis
        </p>
      </div>
      
      <form onSubmit={handleSubmit} className="flex gap-3">
        <Input
          name="trackingNumber"
          placeholder="Numéro de suivi (ex: TRK123456789)"
          className="flex-1 border-2 focus:border-primary"
        />
        <Button type="submit" className="bg-primary hover:bg-accent">
          <Search className="h-4 w-4 mr-2" />
          Rechercher
        </Button>
      </form>
      
      <div className="mt-4 flex gap-2 flex-wrap">
        <button
          type="button"
          onClick={() => onSearch("TRK123456789")}
          className="text-sm text-muted-foreground hover:text-primary transition-colors"
        >
          Essayer: TRK123456789
        </button>
      </div>
    </Card>
  );
}
