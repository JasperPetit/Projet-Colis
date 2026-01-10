import { useState } from 'react';
import { Play, Book, HelpCircle, ChevronDown, ChevronRight } from 'lucide-react';

interface FAQItem {
  question: string;
  answer: string;
}

const faqItems: FAQItem[] = [
  {
    question: 'Comment suivre un colis ?',
    answer:
      "Pour suivre un colis, rendez-vous dans la section 'Colis' du menu principal. Entrez le numéro de suivi fourni par le transporteur ou consultez la liste de vos colis récents.",
  },
  {
    question: 'Comment créer une commande ?',
    answer:
      "Cliquez sur le bouton 'Créer un bon de commande' depuis la page d'accueil, puis remplissez le formulaire avec les informations du fournisseur et les articles souhaités.",
  },
  {
    question: 'Que faire si mon colis est en retard ?',
    answer:
      "Si votre colis accuse un retard, vérifiez d'abord le statut dans la section 'Suivi colis'. Si le problème persiste, contactez le service logistique via le formulaire de contact.",
  },
  {
    question: 'Comment filtrer mes commandes ?',
    answer:
      "Dans la section 'Mes commandes', utilisez les filtres disponibles (date, fournisseur, service) pour affiner votre recherche. Vous pouvez également utiliser la barre de recherche.",
  },
  {
    question: 'Comment contacter un fournisseur ?',
    answer:
      "Rendez-vous dans la section 'Fournisseurs' pour consulter les coordonnées de tous nos fournisseurs référencés (téléphone, email, adresse).",
  },
];

const tutorialSteps = [
  {
    title: 'Créer une commande',
    description: 'Apprenez à créer et soumettre une nouvelle commande',
    duration: '5 min',
  },
  {
    title: 'Suivre un colis',
    description: 'Découvrez comment suivre vos colis en temps réel',
    duration: '3 min',
  },
  {
    title: 'Gérer vos commandes',
    description: 'Consultez et filtrez vos commandes',
    duration: '4 min',
  },
  {
    title: 'Consulter les fournisseurs',
    description: 'Trouvez les informations de contact des fournisseurs',
    duration: '2 min',
  },
];

export default function TutorialPage() {
  const [expandedFAQ, setExpandedFAQ] = useState<number | null>(null);

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Tutoriel & Aide</h1>
        <p className="text-gray-600">Guide d'utilisation de la plateforme</p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div className="lg:col-span-2">
          <div className="bg-white rounded-lg shadow p-6 mb-6">
            <h2 className="mb-4">Vidéos tutorielles</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {tutorialSteps.map((step, index) => (
                <div
                  key={index}
                  className="border border-gray-200 rounded-lg p-4 hover:border-[#1e3a5f] transition-colors cursor-pointer"
                >
                  <div className="aspect-video bg-gray-100 rounded mb-3 flex items-center justify-center">
                    <Play className="w-12 h-12 text-[#1e3a5f]" />
                  </div>
                  <h3 className="mb-1">{step.title}</h3>
                  <p className="text-gray-600 mb-2">{step.description}</p>
                  <div className="text-gray-500 text-sm">Durée: {step.duration}</div>
                </div>
              ))}
            </div>
          </div>

          <div className="bg-white rounded-lg shadow p-6">
            <h2 className="mb-4">Questions fréquentes</h2>
            <div className="space-y-3">
              {faqItems.map((item, index) => (
                <div key={index} className="border border-gray-200 rounded-lg overflow-hidden">
                  <button
                    onClick={() => setExpandedFAQ(expandedFAQ === index ? null : index)}
                    className="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors"
                  >
                    <div className="flex items-center gap-3">
                      <HelpCircle className="w-5 h-5 text-[#1e3a5f] flex-shrink-0" />
                      <span className="text-left">{item.question}</span>
                    </div>
                    {expandedFAQ === index ? (
                      <ChevronDown className="w-5 h-5 text-gray-400 flex-shrink-0" />
                    ) : (
                      <ChevronRight className="w-5 h-5 text-gray-400 flex-shrink-0" />
                    )}
                  </button>
                  {expandedFAQ === index && (
                    <div className="px-4 pb-4 text-gray-600 bg-gray-50">
                      {item.answer}
                    </div>
                  )}
                </div>
              ))}
            </div>
          </div>
        </div>

        <div className="space-y-6">
          <div className="bg-white rounded-lg shadow p-6">
            <div className="flex items-start gap-3 mb-4">
              <Book className="w-6 h-6 text-[#1e3a5f] flex-shrink-0" />
              <div>
                <h2 className="mb-2">Guide utilisateur</h2>
                <p className="text-gray-600">
                  Téléchargez le guide complet d'utilisation de la plateforme
                </p>
              </div>
            </div>
            <button className="w-full bg-[#1e3a5f] text-white px-6 py-2 rounded hover:bg-[#2a4a7f] transition-colors">
              Télécharger le guide (PDF)
            </button>
          </div>

          <div className="bg-blue-50 rounded-lg p-6 border border-blue-200">
            <h3 className="text-[#1e3a5f] mb-2">Besoin d'aide ?</h3>
            <p className="text-gray-700 mb-4">
              Notre équipe support est disponible pour vous aider
            </p>
            <div className="space-y-2 mb-4">
              <div className="text-sm">
                <div className="text-gray-600">Email</div>
                <a href="mailto:support@sorbonne-paris-nord.fr" className="text-[#1e3a5f] hover:underline">
                  support@sorbonne-paris-nord.fr
                </a>
              </div>
              <div className="text-sm">
                <div className="text-gray-600">Téléphone</div>
                <a href="tel:0148263000" className="text-[#1e3a5f] hover:underline">
                  01 48 26 30 00
                </a>
              </div>
              <div className="text-sm">
                <div className="text-gray-600">Horaires</div>
                <div className="text-gray-700">Lun-Ven: 9h-17h</div>
              </div>
            </div>
            <button className="w-full bg-white border-2 border-[#1e3a5f] text-[#1e3a5f] px-6 py-2 rounded hover:bg-gray-50 transition-colors">
              Contacter le support
            </button>
          </div>

          <div className="bg-amber-50 rounded-lg p-6 border border-amber-200">
            <h3 className="text-amber-900 mb-2">Nouveautés</h3>
            <p className="text-amber-800 text-sm mb-3">
              Version 2.1 - Novembre 2024
            </p>
            <ul className="text-amber-900 text-sm space-y-1">
              <li>• Nouveau système de suivi en temps réel</li>
              <li>• Filtres améliorés pour les commandes</li>
              <li>• Interface mobile optimisée</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}
