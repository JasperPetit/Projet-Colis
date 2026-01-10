import { useState } from 'react';
import { Home, Package, ShoppingCart, Users, BookOpen, FileText } from 'lucide-react';
import Sidebar from './components/Sidebar';
import HomePage from './components/HomePage';
import MyOrdersPage from './components/MyOrdersPage';
import TrackingPage from './components/TrackingPage';
import SuppliersPage from './components/SuppliersPage';
import TutorialPage from './components/TutorialPage';
import OrderFormPage from './components/OrderFormPage';
import Header from './components/Header';

export default function App() {
  const [currentPage, setCurrentPage] = useState('accueil');
  const [isLoggedIn, setIsLoggedIn] = useState(true);

  const navigationItems = [
    { id: 'accueil', label: 'Accueil', icon: Home },
    { id: 'nouvelle-commande', label: 'Nouvelle commande', icon: FileText },
    { id: 'commandes', label: 'Mes commandes', icon: ShoppingCart },
    { id: 'colis', label: 'Colis', icon: Package },
    { id: 'fournisseurs', label: 'Fournisseurs', icon: Users },
    { id: 'tutoriel', label: 'Tutoriel', icon: BookOpen },
  ];

  const renderPage = () => {
    switch (currentPage) {
      case 'accueil':
        return <HomePage onNavigate={setCurrentPage} />;
      case 'nouvelle-commande':
        return <OrderFormPage />;
      case 'commandes':
        return <MyOrdersPage />;
      case 'colis':
        return <TrackingPage />;
      case 'fournisseurs':
        return <SuppliersPage />;
      case 'tutoriel':
        return <TutorialPage />;
      default:
        return <HomePage onNavigate={setCurrentPage} />;
    }
  };

  if (!isLoggedIn) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div className="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
          <div className="flex items-center justify-center mb-8">
            <div className="bg-[#1e3a5f] text-white px-6 py-4 rounded">
              <div className="flex items-center gap-2">
                <Package className="w-6 h-6" />
                <div>
                  <div>SORBONNE</div>
                  <div>PARIS NORD</div>
                </div>
              </div>
            </div>
          </div>
          <h2 className="text-center mb-6">Connexion</h2>
          <input
            type="text"
            placeholder="Identifiant universitaire"
            className="w-full px-4 py-2 border border-gray-300 rounded mb-4"
          />
          <button
            onClick={() => setIsLoggedIn(true)}
            className="w-full bg-[#f5b942] text-[#1e3a5f] px-6 py-2 rounded hover:bg-[#e5a932] transition-colors"
          >
            Se connecter
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50 flex">
      <Sidebar
        items={navigationItems}
        currentPage={currentPage}
        onNavigate={setCurrentPage}
      />
      <div className="flex-1 flex flex-col">
        <Header onLogout={() => setIsLoggedIn(false)} />
        <main className="flex-1 overflow-auto">
          {renderPage()}
        </main>
      </div>
    </div>
  );
}
