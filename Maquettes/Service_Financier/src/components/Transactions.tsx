import { Search, Download, Filter } from 'lucide-react';
import { RecentTransactions } from './RecentTransactions';

export function Transactions() {
  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-[#00205B] mb-2">Gestion des Transactions</h1>
        <p className="text-gray-600">Consultez et gérez toutes les transactions financières</p>
      </div>

      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
          <div className="flex-1 flex items-center gap-2 bg-gray-50 rounded px-4 py-2">
            <Search className="text-gray-400" size={20} />
            <input
              type="text"
              placeholder="Rechercher une transaction..."
              className="flex-1 bg-transparent outline-none"
            />
          </div>
          <div className="flex gap-2">
            <button className="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
              <Filter size={20} />
              Filtrer
            </button>
            <button className="flex items-center gap-2 px-4 py-2 bg-[#f5b342] text-[#00205B] rounded hover:bg-[#f5c663] transition-colors">
              <Download size={20} />
              Exporter
            </button>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          <div className="p-4 bg-green-50 rounded border border-green-200">
            <p className="text-gray-600 mb-1">Total des paiements reçus</p>
            <p className="text-green-600">87 560 €</p>
            <p className="text-gray-500">245 transactions</p>
          </div>
          <div className="p-4 bg-yellow-50 rounded border border-yellow-200">
            <p className="text-gray-600 mb-1">En attente de paiement</p>
            <p className="text-yellow-600">3 850 €</p>
            <p className="text-gray-500">12 transactions</p>
          </div>
          <div className="p-4 bg-red-50 rounded border border-red-200">
            <p className="text-gray-600 mb-1">Paiements en retard</p>
            <p className="text-red-600">2 340 €</p>
            <p className="text-gray-500">7 transactions</p>
          </div>
        </div>
      </div>

      <RecentTransactions />
    </div>
  );
}
