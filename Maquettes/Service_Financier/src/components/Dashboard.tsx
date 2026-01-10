import { Package, Clock, CheckCircle, TrendingUp, Euro, CreditCard, AlertCircle } from 'lucide-react';
import { StatCard } from './StatCard';
import { RecentTransactions } from './RecentTransactions';

export function Dashboard() {
  return (
    <div className="space-y-8">
      <div>
        <h1 className="text-[#00205B] mb-2">Service Financier - Suivi Colis</h1>
        <p className="text-gray-600">IUT de Villetaneuse</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <StatCard
          title="Revenus du mois"
          value="15 420 €"
          icon={Euro}
          iconBgColor="bg-green-100"
          iconColor="text-green-600"
        />
        <StatCard
          title="Paiements en attente"
          value="3 850 €"
          icon={Clock}
          iconBgColor="bg-yellow-100"
          iconColor="text-yellow-600"
          count={12}
        />
        <StatCard
          title="Factures impayées"
          value="2 340 €"
          icon={AlertCircle}
          iconBgColor="bg-red-100"
          iconColor="text-red-600"
          count={7}
        />
        <StatCard
          title="Transactions réussies"
          value="87 560 €"
          icon={CheckCircle}
          iconBgColor="bg-blue-100"
          iconColor="text-blue-600"
          count={245}
        />
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-[#00205B] mb-6">Statistiques des colis</h2>
          <div className="space-y-4">
            <div className="flex items-center justify-between p-4 bg-gray-50 rounded">
              <div className="flex items-center gap-3">
                <div className="bg-[#00205B] p-3 rounded">
                  <Package className="text-white" size={24} />
                </div>
                <div>
                  <p className="text-gray-600">Colis en attente de paiement</p>
                  <p className="text-[#00205B]">12 colis</p>
                </div>
              </div>
              <p className="text-[#00205B]">3 850 €</p>
            </div>

            <div className="flex items-center justify-between p-4 bg-gray-50 rounded">
              <div className="flex items-center gap-3">
                <div className="bg-[#f5b342] p-3 rounded">
                  <CheckCircle className="text-white" size={24} />
                </div>
                <div>
                  <p className="text-gray-600">Colis payés aujourd'hui</p>
                  <p className="text-[#00205B]">28 colis</p>
                </div>
              </div>
              <p className="text-[#00205B]">7 240 €</p>
            </div>

            <div className="flex items-center justify-between p-4 bg-gray-50 rounded">
              <div className="flex items-center gap-3">
                <div className="bg-green-500 p-3 rounded">
                  <TrendingUp className="text-white" size={24} />
                </div>
                <div>
                  <p className="text-gray-600">Revenus cette semaine</p>
                  <p className="text-[#00205B]">156 colis</p>
                </div>
              </div>
              <p className="text-[#00205B]">42 890 €</p>
            </div>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-[#00205B]">Actions rapides</h2>
          </div>
          <div className="space-y-3">
            <button className="w-full px-6 py-4 bg-[#f5b342] text-[#00205B] rounded hover:bg-[#f5c663] transition-colors flex items-center justify-center gap-2">
              <CreditCard size={20} />
              Créer une facture
            </button>
            <button className="w-full px-6 py-4 border-2 border-[#00205B] text-[#00205B] rounded hover:bg-[#00205B] hover:text-white transition-colors flex items-center justify-center gap-2">
              <Package size={20} />
              Scanner un colis
            </button>
            <button className="w-full px-6 py-4 border-2 border-[#00205B] text-[#00205B] rounded hover:bg-[#00205B] hover:text-white transition-colors flex items-center justify-center gap-2">
              <Euro size={20} />
              Enregistrer un paiement
            </button>
          </div>

          <div className="mt-8 p-4 bg-blue-50 rounded border border-blue-200">
            <p className="text-[#00205B] mb-2">Rappel</p>
            <p className="text-gray-600">7 factures arrivent à échéance dans les 3 prochains jours</p>
          </div>
        </div>
      </div>

      <RecentTransactions />
    </div>
  );
}
