import { useState } from 'react';
import { Search, Filter, Calendar, Building, Users } from 'lucide-react';

interface Order {
  id: string;
  reference: string;
  date: string;
  supplier: string;
  service: string;
  status: 'En attente' | 'En cours' | 'Livré' | 'Annulé';
  items: number;
  total: string;
}

const mockOrders: Order[] = [
  {
    id: '1',
    reference: 'CMD-2024-001',
    date: '2024-11-20',
    supplier: 'Bureau Plus',
    service: 'IUT Villetaneuse',
    status: 'Livré',
    items: 5,
    total: '245.50€',
  },
  {
    id: '2',
    reference: 'CMD-2024-002',
    date: '2024-11-22',
    supplier: 'TechSupply',
    service: 'IUT Villetaneuse',
    status: 'En cours',
    items: 3,
    total: '1,250.00€',
  },
  {
    id: '3',
    reference: 'CMD-2024-003',
    date: '2024-11-25',
    supplier: 'Office Depot',
    service: 'IUT Villetaneuse',
    status: 'En attente',
    items: 12,
    total: '487.20€',
  },
  {
    id: '4',
    reference: 'CMD-2024-004',
    date: '2024-11-27',
    supplier: 'Bureau Plus',
    service: 'Administration',
    status: 'En cours',
    items: 7,
    total: '320.00€',
  },
];

export default function MyOrdersPage() {
  const [searchTerm, setSearchTerm] = useState('');
  const [filterDate, setFilterDate] = useState('');
  const [filterSupplier, setFilterSupplier] = useState('');
  const [filterService, setFilterService] = useState('');

  const filteredOrders = mockOrders.filter((order) => {
    const matchesSearch = order.reference.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         order.supplier.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesDate = !filterDate || order.date >= filterDate;
    const matchesSupplier = !filterSupplier || order.supplier === filterSupplier;
    const matchesService = !filterService || order.service === filterService;
    
    return matchesSearch && matchesDate && matchesSupplier && matchesService;
  });

  const getStatusColor = (status: Order['status']) => {
    switch (status) {
      case 'Livré':
        return 'bg-green-100 text-green-800';
      case 'En cours':
        return 'bg-blue-100 text-blue-800';
      case 'En attente':
        return 'bg-amber-100 text-amber-800';
      case 'Annulé':
        return 'bg-red-100 text-red-800';
      default:
        return 'bg-gray-100 text-gray-800';
    }
  };

  return (
    <div className="p-8">
      <div className="mb-8">
        <h1 className="text-[#1e3a5f] mb-2">Mes Commandes</h1>
        <p className="text-gray-600">Historique complet de vos commandes</p>
      </div>

      <div className="bg-white rounded-lg shadow mb-6 p-6">
        <div className="flex items-center gap-4 mb-4">
          <div className="flex-1 relative">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <input
              type="text"
              placeholder="Rechercher une commande..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded"
            />
          </div>
          <button className="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded hover:bg-gray-50">
            <Filter className="w-5 h-5" />
            Filtres
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div className="relative">
            <Calendar className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <input
              type="date"
              value={filterDate}
              onChange={(e) => setFilterDate(e.target.value)}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded"
            />
          </div>
          <div className="relative">
            <Building className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <select
              value={filterSupplier}
              onChange={(e) => setFilterSupplier(e.target.value)}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded appearance-none"
            >
              <option value="">Tous les fournisseurs</option>
              <option value="Bureau Plus">Bureau Plus</option>
              <option value="TechSupply">TechSupply</option>
              <option value="Office Depot">Office Depot</option>
            </select>
          </div>
          <div className="relative">
            <Users className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <select
              value={filterService}
              onChange={(e) => setFilterService(e.target.value)}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded appearance-none"
            >
              <option value="">Tous les services</option>
              <option value="IUT Villetaneuse">IUT Villetaneuse</option>
              <option value="Administration">Administration</option>
            </select>
          </div>
        </div>
      </div>

      <div className="bg-white rounded-lg shadow overflow-hidden">
        <table className="w-full">
          <thead className="bg-gray-50 border-b border-gray-200">
            <tr>
              <th className="text-left px-6 py-3 text-gray-600">Référence</th>
              <th className="text-left px-6 py-3 text-gray-600">Date</th>
              <th className="text-left px-6 py-3 text-gray-600">Fournisseur</th>
              <th className="text-left px-6 py-3 text-gray-600">Service</th>
              <th className="text-left px-6 py-3 text-gray-600">Statut</th>
              <th className="text-left px-6 py-3 text-gray-600">Articles</th>
              <th className="text-left px-6 py-3 text-gray-600">Total</th>
              <th className="text-left px-6 py-3 text-gray-600">Action</th>
            </tr>
          </thead>
          <tbody>
            {filteredOrders.map((order) => (
              <tr key={order.id} className="border-b border-gray-100 hover:bg-gray-50">
                <td className="px-6 py-4">{order.reference}</td>
                <td className="px-6 py-4">{new Date(order.date).toLocaleDateString('fr-FR')}</td>
                <td className="px-6 py-4">{order.supplier}</td>
                <td className="px-6 py-4">{order.service}</td>
                <td className="px-6 py-4">
                  <span className={`px-3 py-1 rounded-full text-sm ${getStatusColor(order.status)}`}>
                    {order.status}
                  </span>
                </td>
                <td className="px-6 py-4">{order.items}</td>
                <td className="px-6 py-4">{order.total}</td>
                <td className="px-6 py-4">
                  <button className="text-[#1e3a5f] hover:underline">
                    Détails
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <div className="mt-6 flex items-center justify-between">
        <p className="text-gray-600">
          Affichage de {filteredOrders.length} commande(s)
        </p>
      </div>
    </div>
  );
}
