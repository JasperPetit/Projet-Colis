import { Package, TruckIcon, CheckCircle, Clock, ScanLine, Send } from 'lucide-react';

interface DashboardProps {
  setCurrentView: (view: 'dashboard' | 'scanner' | 'tracking' | 'new-shipment') => void;
}

export function Dashboard({ setCurrentView }: DashboardProps) {
  const stats = [
    { label: 'Colis en attente', value: 24, icon: Clock, color: 'text-orange-500' },
    { label: 'En cours de livraison', value: 17, icon: TruckIcon, color: 'text-blue-500' },
    { label: 'Livrés aujourd\'hui', value: 43, icon: CheckCircle, color: 'text-green-500' },
    { label: 'Total cette semaine', value: 156, icon: Package, color: 'text-[#1a3a5c]' },
  ];

  const recentPackages = [
    { id: 'CP2024-11-001', destination: 'Paris 13e', status: 'En cours', time: '10:23' },
    { id: 'CP2024-11-002', destination: 'Villetaneuse', status: 'Livré', time: '09:45' },
    { id: 'CP2024-11-003', destination: 'Saint-Denis', status: 'En attente', time: '09:12' },
    { id: 'CP2024-11-004', destination: 'Bobigny', status: 'En cours', time: '08:55' },
    { id: 'CP2024-11-005', destination: 'Paris 18e', status: 'Livré', time: '08:30' },
  ];

  return (
    <div className="max-w-7xl">
      <div className="mb-8">
        <h1 className="text-[#1a3a5c] mb-2">Tableau de bord postal</h1>
        <p className="text-gray-600">Vue d'ensemble des opérations du jour - 28 novembre 2025</p>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {stats.map((stat, index) => (
          <div key={index} className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div className="flex justify-between items-start mb-4">
              <div>
                <p className="text-gray-600 text-sm mb-1">{stat.label}</p>
                <p className={`text-4xl ${stat.color}`}>{stat.value}</p>
              </div>
              <stat.icon className={`w-8 h-8 ${stat.color}`} />
            </div>
          </div>
        ))}
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <button
          onClick={() => setCurrentView('scanner')}
          className="bg-gradient-to-r from-[#1a3a5c] to-[#2d5273] hover:from-[#2d5273] hover:to-[#1a3a5c] text-white p-8 rounded-lg shadow-lg transition-all flex items-center gap-4"
        >
          <div className="bg-white/20 p-4 rounded-lg">
            <ScanLine className="w-8 h-8" />
          </div>
          <div className="text-left">
            <h3 className="mb-1">Scanner un colis</h3>
            <p className="text-sm opacity-90">Scannez le code-barres d'un colis</p>
          </div>
        </button>

        <button
          onClick={() => setCurrentView('new-shipment')}
          className="bg-gradient-to-r from-[#f4b942] to-[#e5a832] hover:from-[#e5a832] hover:to-[#f4b942] text-[#1a3a5c] p-8 rounded-lg shadow-lg transition-all flex items-center gap-4"
        >
          <div className="bg-white/40 p-4 rounded-lg">
            <Send className="w-8 h-8" />
          </div>
          <div className="text-left">
            <h3 className="mb-1">Nouvel envoi</h3>
            <p className="text-sm opacity-90">Créer un nouveau bon d'expédition</p>
          </div>
        </button>
      </div>

      {/* Recent Packages */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200">
        <div className="p-6 border-b border-gray-200">
          <h2 className="text-[#1a3a5c]">Activité récente</h2>
        </div>
        <div className="divide-y divide-gray-200">
          {recentPackages.map((pkg) => (
            <div key={pkg.id} className="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
              <div className="flex items-center gap-4">
                <div className="bg-gray-100 p-3 rounded">
                  <Package className="w-5 h-5 text-[#1a3a5c]" />
                </div>
                <div>
                  <p className="text-[#1a3a5c]">{pkg.id}</p>
                  <p className="text-sm text-gray-600">Destination: {pkg.destination}</p>
                </div>
              </div>
              <div className="flex items-center gap-6">
                <span className="text-sm text-gray-500">{pkg.time}</span>
                <span
                  className={`px-4 py-1 rounded-full text-sm ${
                    pkg.status === 'Livré'
                      ? 'bg-green-100 text-green-700'
                      : pkg.status === 'En cours'
                      ? 'bg-blue-100 text-blue-700'
                      : 'bg-orange-100 text-orange-700'
                  }`}
                >
                  {pkg.status}
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
