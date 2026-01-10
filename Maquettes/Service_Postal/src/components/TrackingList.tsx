import { useState } from 'react';
import { Package, Filter, Download, MapPin, Calendar } from 'lucide-react';

export function TrackingList() {
  const [filterStatus, setFilterStatus] = useState<string>('all');

  const packages = [
    {
      id: 'CP2024-11-001',
      recipient: 'Jean Martin',
      address: 'Paris 13e',
      status: 'Livré',
      date: '28/11/2025',
      time: '14:30',
      weight: '1.2 kg',
      type: 'Standard',
    },
    {
      id: 'CP2024-11-002',
      recipient: 'Sophie Laurent',
      address: 'Villetaneuse',
      status: 'En cours',
      date: '28/11/2025',
      time: '10:15',
      weight: '3.5 kg',
      type: 'Express',
    },
    {
      id: 'CP2024-11-003',
      recipient: 'Pierre Dubois',
      address: 'Saint-Denis',
      status: 'En attente',
      date: '28/11/2025',
      time: '09:00',
      weight: '0.8 kg',
      type: 'Standard',
    },
    {
      id: 'CP2024-11-004',
      recipient: 'Marie Chen',
      address: 'Bobigny',
      status: 'En cours',
      date: '28/11/2025',
      time: '11:45',
      weight: '2.1 kg',
      type: 'Standard',
    },
    {
      id: 'CP2024-11-005',
      recipient: 'Ahmed Ben Ali',
      address: 'Paris 18e',
      status: 'Livré',
      date: '28/11/2025',
      time: '13:20',
      weight: '1.9 kg',
      type: 'Express',
    },
    {
      id: 'CP2024-11-006',
      recipient: 'Lucie Bernard',
      address: 'Aubervilliers',
      status: 'En attente',
      date: '28/11/2025',
      time: '08:30',
      weight: '4.2 kg',
      type: 'Standard',
    },
  ];

  const filteredPackages = filterStatus === 'all' 
    ? packages 
    : packages.filter(pkg => pkg.status === filterStatus);

  const statusCounts = {
    all: packages.length,
    'En attente': packages.filter(p => p.status === 'En attente').length,
    'En cours': packages.filter(p => p.status === 'En cours').length,
    'Livré': packages.filter(p => p.status === 'Livré').length,
  };

  return (
    <div className="max-w-7xl">
      <div className="mb-8 flex justify-between items-center">
        <div>
          <h1 className="text-[#1a3a5c] mb-2">Suivi des colis</h1>
          <p className="text-gray-600">Liste complète des colis en cours de traitement</p>
        </div>
        <button className="flex items-center gap-2 bg-[#f4b942] hover:bg-[#e5a832] text-[#1a3a5c] px-6 py-3 rounded transition-colors">
          <Download className="w-4 h-4" />
          Exporter
        </button>
      </div>

      {/* Filter Tabs */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div className="flex gap-2 p-2">
          {Object.entries(statusCounts).map(([status, count]) => (
            <button
              key={status}
              onClick={() => setFilterStatus(status)}
              className={`flex-1 px-4 py-3 rounded transition-colors ${
                filterStatus === status
                  ? 'bg-[#1a3a5c] text-white'
                  : 'bg-white text-gray-600 hover:bg-gray-50'
              }`}
            >
              <span>{status === 'all' ? 'Tous' : status}</span>
              <span className={`ml-2 px-2 py-0.5 rounded-full text-sm ${
                filterStatus === status
                  ? 'bg-white/20'
                  : 'bg-gray-100'
              }`}>
                {count}
              </span>
            </button>
          ))}
        </div>
      </div>

      {/* Packages Table */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50 border-b border-gray-200">
              <tr>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Numéro</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Destinataire</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Destination</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Type</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Poids</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Date/Heure</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Statut</th>
                <th className="text-left px-6 py-4 text-sm text-gray-600">Actions</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-200">
              {filteredPackages.map((pkg) => (
                <tr key={pkg.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="bg-gray-100 p-2 rounded">
                        <Package className="w-4 h-4 text-[#1a3a5c]" />
                      </div>
                      <span className="text-[#1a3a5c]">{pkg.id}</span>
                    </div>
                  </td>
                  <td className="px-6 py-4 text-gray-700">{pkg.recipient}</td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-2 text-gray-700">
                      <MapPin className="w-4 h-4 text-gray-400" />
                      {pkg.address}
                    </div>
                  </td>
                  <td className="px-6 py-4 text-gray-700">{pkg.type}</td>
                  <td className="px-6 py-4 text-gray-700">{pkg.weight}</td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-2 text-gray-700">
                      <Calendar className="w-4 h-4 text-gray-400" />
                      <div>
                        <div className="text-sm">{pkg.date}</div>
                        <div className="text-xs text-gray-500">{pkg.time}</div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4">
                    <span
                      className={`px-3 py-1 rounded-full text-sm ${
                        pkg.status === 'Livré'
                          ? 'bg-green-100 text-green-700'
                          : pkg.status === 'En cours'
                          ? 'bg-blue-100 text-blue-700'
                          : 'bg-orange-100 text-orange-700'
                      }`}
                    >
                      {pkg.status}
                    </span>
                  </td>
                  <td className="px-6 py-4">
                    <button className="text-[#1a3a5c] hover:text-[#2d5273] text-sm underline">
                      Détails
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}
