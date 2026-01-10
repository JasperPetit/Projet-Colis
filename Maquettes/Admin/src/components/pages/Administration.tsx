import { Users, Settings, Database, Shield, Bell, FileText } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";
import { Switch } from "../ui/switch";

export function Administration() {
  const adminSections = [
    {
      title: "Gestion des utilisateurs",
      description: "Gérez les comptes utilisateurs et leurs permissions",
      icon: Users,
      actions: ["Voir les utilisateurs", "Ajouter un utilisateur"]
    },
    {
      title: "Paramètres système",
      description: "Configuration générale du système de suivi",
      icon: Settings,
      actions: ["Paramètres généraux", "Préférences"]
    },
    {
      title: "Base de données",
      description: "Sauvegarde et maintenance de la base de données",
      icon: Database,
      actions: ["Sauvegarder", "Restaurer"]
    },
    {
      title: "Sécurité",
      description: "Gestion de la sécurité et des accès",
      icon: Shield,
      actions: ["Logs de sécurité", "Politiques"]
    },
  ];

  const notificationSettings = [
    { id: "email", label: "Notifications par email", enabled: true },
    { id: "sms", label: "Notifications par SMS", enabled: false },
    { id: "push", label: "Notifications push", enabled: true },
    { id: "livraison", label: "Alertes de livraison", enabled: true },
  ];

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Administration</h1>
        <p className="text-muted-foreground">Gérez les paramètres et configurations du système</p>
      </div>

      <div className="grid md:grid-cols-2 gap-6 mb-8">
        {adminSections.map((section) => {
          const Icon = section.icon;
          return (
            <Card key={section.title} className="p-6 hover:shadow-lg transition-shadow">
              <div className="flex items-start gap-4 mb-4">
                <div className="bg-primary/10 p-3 rounded-lg">
                  <Icon className="h-6 w-6 text-primary" />
                </div>
                <div className="flex-1">
                  <h3 className="text-foreground mb-1">{section.title}</h3>
                  <p className="text-sm text-muted-foreground">{section.description}</p>
                </div>
              </div>
              <div className="flex gap-2">
                {section.actions.map((action) => (
                  <Button
                    key={action}
                    variant="outline"
                    className="border-primary text-primary hover:bg-primary/5"
                    size="sm"
                  >
                    {action}
                  </Button>
                ))}
              </div>
            </Card>
          );
        })}
      </div>

      <Card className="p-6 mb-6">
        <div className="flex items-center gap-3 mb-6">
          <div className="bg-primary/10 p-3 rounded-lg">
            <Bell className="h-6 w-6 text-primary" />
          </div>
          <div>
            <h3 className="text-foreground">Paramètres de notifications</h3>
            <p className="text-sm text-muted-foreground">Configurez vos préférences de notifications</p>
          </div>
        </div>
        <div className="space-y-4">
          {notificationSettings.map((setting) => (
            <div key={setting.id} className="flex items-center justify-between py-3 border-b border-border last:border-0">
              <span className="text-foreground">{setting.label}</span>
              <Switch defaultChecked={setting.enabled} />
            </div>
          ))}
        </div>
      </Card>

      <Card className="p-6">
        <div className="flex items-center gap-3 mb-6">
          <div className="bg-primary/10 p-3 rounded-lg">
            <FileText className="h-6 w-6 text-primary" />
          </div>
          <div>
            <h3 className="text-foreground">Rapports et statistiques</h3>
            <p className="text-sm text-muted-foreground">Générez des rapports détaillés</p>
          </div>
        </div>
        <div className="grid md:grid-cols-3 gap-4">
          <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
            Rapport mensuel
          </Button>
          <Button variant="outline" className="border-primary text-primary hover:bg-primary/5">
            Rapport annuel
          </Button>
          <Button className="bg-accent hover:bg-accent/90 text-accent-foreground">
            Export personnalisé
          </Button>
        </div>
      </Card>
    </div>
  );
}
