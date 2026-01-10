import { CheckCircle2, Circle, Package, Truck, Building2, MapPin } from "lucide-react";
import { Card } from "./ui/card";
import { Badge } from "./ui/badge";

interface TimelineEvent {
  id: string;
  status: string;
  location: string;
  date: string;
  time: string;
  completed: boolean;
  icon: React.ReactNode;
}

interface TrackingTimelineProps {
  trackingNumber: string;
}

export function TrackingTimeline({ trackingNumber }: TrackingTimelineProps) {
  const events: TimelineEvent[] = [
    {
      id: "1",
      status: "Livré",
      location: "Bureau de poste universitaire - Bâtiment A",
      date: "12 Oct 2025",
      time: "14:30",
      completed: true,
      icon: <MapPin className="h-5 w-5" />
    },
    {
      id: "2",
      status: "En cours de livraison",
      location: "Centre de tri - Campus Principal",
      date: "12 Oct 2025",
      time: "09:15",
      completed: true,
      icon: <Truck className="h-5 w-5" />
    },
    {
      id: "3",
      status: "Arrivé au centre de distribution",
      location: "Hub régional - Ville universitaire",
      date: "11 Oct 2025",
      time: "18:45",
      completed: true,
      icon: <Building2 className="h-5 w-5" />
    },
    {
      id: "4",
      status: "Colis en transit",
      location: "Centre de tri national",
      date: "10 Oct 2025",
      time: "12:00",
      completed: true,
      icon: <Truck className="h-5 w-5" />
    },
    {
      id: "5",
      status: "Colis expédié",
      location: "Entrepôt d'origine",
      date: "9 Oct 2025",
      time: "08:30",
      completed: true,
      icon: <Package className="h-5 w-5" />
    }
  ];

  return (
    <Card className="p-6 shadow-lg">
      <div className="flex items-center justify-between mb-6">
        <div>
          <h3 className="text-primary">Statut du colis</h3>
          <p className="text-muted-foreground">Numéro: {trackingNumber}</p>
        </div>
        <Badge className="bg-green-500 text-white">
          Livré
        </Badge>
      </div>

      <div className="space-y-6">
        {events.map((event, index) => (
          <div key={event.id} className="flex gap-4">
            <div className="flex flex-col items-center">
              <div
                className={`rounded-full p-2 ${
                  event.completed
                    ? "bg-primary text-white"
                    : "bg-muted text-muted-foreground"
                }`}
              >
                {event.icon}
              </div>
              {index < events.length - 1 && (
                <div
                  className={`w-0.5 h-16 ${
                    event.completed ? "bg-primary" : "bg-border"
                  }`}
                />
              )}
            </div>

            <div className="flex-1 pb-8">
              <div className="flex items-start justify-between">
                <div>
                  <h4 className={event.completed ? "text-foreground" : "text-muted-foreground"}>
                    {event.status}
                  </h4>
                  <p className="text-muted-foreground text-sm mt-1">
                    {event.location}
                  </p>
                </div>
                <div className="text-right text-sm text-muted-foreground">
                  <div>{event.date}</div>
                  <div>{event.time}</div>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </Card>
  );
}
