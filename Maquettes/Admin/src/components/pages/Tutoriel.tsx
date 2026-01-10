import { BookOpen, Video, FileText, HelpCircle, ExternalLink } from "lucide-react";
import { Card } from "../ui/card";
import { Button } from "../ui/button";

export function Tutoriel() {
  const tutoriels = [
    {
      titre: "Guide de démarrage rapide",
      description: "Apprenez les bases du système de suivi de colis en 5 minutes",
      type: "Article",
      duree: "5 min",
      icon: FileText,
      badge: "Nouveau"
    },
    {
      titre: "Comment créer un bon de commande",
      description: "Tutoriel vidéo complet sur la création et la gestion des commandes",
      type: "Vidéo",
      duree: "8 min",
      icon: Video,
      badge: null
    },
    {
      titre: "Scanner et enregistrer un colis",
      description: "Guide pratique pour scanner et enregistrer l'arrivée d'un colis",
      type: "Article",
      duree: "3 min",
      icon: FileText,
      badge: null
    },
    {
      titre: "Gérer les fournisseurs",
      description: "Comment ajouter et gérer vos fournisseurs dans le système",
      type: "Vidéo",
      duree: "6 min",
      icon: Video,
      badge: null
    },
  ];

  const faq = [
    {
      question: "Comment suivre un colis en attente ?",
      reponse: "Accédez à la page 'Colis' et utilisez le numéro de tracking pour suivre votre colis en temps réel."
    },
    {
      question: "Qui peut créer un bon de commande ?",
      reponse: "Seuls les utilisateurs avec le rôle 'Gestionnaire' ou 'Administrateur' peuvent créer des bons de commande."
    },
    {
      question: "Comment recevoir des notifications ?",
      reponse: "Configurez vos préférences de notifications dans la section 'Administration' > 'Paramètres de notifications'."
    },
  ];

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-primary mb-1">Centre d'aide et Tutoriels</h1>
        <p className="text-muted-foreground">Apprenez à utiliser toutes les fonctionnalités du système</p>
      </div>

      <div className="mb-8">
        <h2 className="text-primary mb-4">Tutoriels recommandés</h2>
        <div className="grid md:grid-cols-2 gap-6">
          {tutoriels.map((tuto, index) => {
            const Icon = tuto.icon;
            return (
              <Card key={index} className="p-6 hover:shadow-lg transition-shadow">
                <div className="flex items-start gap-4">
                  <div className="bg-primary/10 p-3 rounded-lg">
                    <Icon className="h-6 w-6 text-primary" />
                  </div>
                  <div className="flex-1">
                    <div className="flex items-start justify-between mb-2">
                      <h3 className="text-foreground">{tuto.titre}</h3>
                      {tuto.badge && (
                        <span className="bg-accent text-accent-foreground px-2 py-1 rounded text-xs">
                          {tuto.badge}
                        </span>
                      )}
                    </div>
                    <p className="text-sm text-muted-foreground mb-3">{tuto.description}</p>
                    <div className="flex items-center justify-between">
                      <div className="flex items-center gap-3 text-sm text-muted-foreground">
                        <span>{tuto.type}</span>
                        <span>•</span>
                        <span>{tuto.duree}</span>
                      </div>
                      <Button variant="outline" className="border-primary text-primary hover:bg-primary/5" size="sm">
                        <ExternalLink className="h-4 w-4 mr-1" />
                        Ouvrir
                      </Button>
                    </div>
                  </div>
                </div>
              </Card>
            );
          })}
        </div>
      </div>

      <Card className="p-6">
        <div className="flex items-center gap-3 mb-6">
          <div className="bg-primary/10 p-3 rounded-lg">
            <HelpCircle className="h-6 w-6 text-primary" />
          </div>
          <div>
            <h2 className="text-primary">Questions fréquentes (FAQ)</h2>
            <p className="text-sm text-muted-foreground">Trouvez rapidement des réponses à vos questions</p>
          </div>
        </div>
        <div className="space-y-4">
          {faq.map((item, index) => (
            <div key={index} className="border-b border-border pb-4 last:border-0 last:pb-0">
              <h4 className="text-foreground mb-2">{item.question}</h4>
              <p className="text-sm text-muted-foreground">{item.reponse}</p>
            </div>
          ))}
        </div>
        <div className="mt-6 pt-6 border-t border-border text-center">
          <p className="text-muted-foreground mb-4">Vous ne trouvez pas de réponse à votre question ?</p>
          <Button className="bg-accent hover:bg-accent/90 text-accent-foreground">
            Contacter le support
          </Button>
        </div>
      </Card>
    </div>
  );
}
