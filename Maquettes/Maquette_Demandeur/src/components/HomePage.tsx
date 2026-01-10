import { Package, ShoppingCart, CheckCircle, DollarSign } from 'lucide-react';
import StatCard from './StatCard';

interface HomePageProps {
  onNavigate?: (page: string) => void;
}

export default function HomePage({ onNavigate }: HomePageProps = {}) {
  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Suivi Colis</h1>
        <p className="text-gray-600">IUT de Villetaneuse</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <StatCard
          title="Colis en attente"
          value={5}
          icon={Package}
          iconBg="bg-blue-100"
          iconColor="text-blue-600"
        />
        <StatCard
          title="Commandes en cours"
          value={3}
          icon={ShoppingCart}
          iconBg="bg-purple-100"
          iconColor="text-purple-600"
        />
        <StatCard
          title="Derniers colis livrés"
          value={7}
          icon={CheckCircle}
          iconBg="bg-green-100"
          iconColor="text-green-600"
        />
        <StatCard
          title="Total reçus / payés"
          value={42}
          icon={DollarSign}
          iconBg="bg-amber-100"
          iconColor="text-amber-600"
        />
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white rounded-lg shadow p-6">
          <h2 className="mb-4">Activité récente</h2>
          <div className="space-y-4">
            <ActivityItem
              status="Livré"
              description="Colis #1234 - Bureau 203"
              date="Il y a 2 heures"
              statusColor="text-green-600"
            />
            <ActivityItem
              status="En transit"
              description="Colis #1235 - Réception"
              date="Il y a 5 heures"
              statusColor="text-blue-600"
            />
            <ActivityItem
              status="En attente"
              description="Colis #1236 - En préparation"
              date="Hier"
              statusColor="text-amber-600"
            />
          </div>
        </div>

        <div className="bg-white rounded-lg shadow p-6">
          <h2 className="mb-4">Actions rapides</h2>
          <div className="space-y-3">
            <button 
              onClick={() => onNavigate?.('nouvelle-commande')}
              className="w-full bg-[#f5b942] text-[#1e3a5f] px-6 py-3 rounded hover:bg-[#e5a932] transition-colors"
            >
              Créer une commande
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

function ActivityItem({ status, description, date, statusColor }: {
  status: string;
  description: string;
  date: string;
  statusColor: string;
}) {
  return (
    <div className="flex items-start gap-3 p-3 bg-gray-50 rounded">
      <div className="w-2 h-2 rounded-full bg-current mt-2" style={{ color: statusColor.replace('text-', '') }} />
      <div className="flex-1">
        <div className="flex items-center gap-2 mb-1">
          <span className={`${statusColor}`}>{status}</span>
        </div>
        <p className="text-gray-700">{description}</p>
        <p className="text-gray-500 text-sm mt-1">{date}</p>
      </div>
    </div>
  );
}
