import { TrendingUp, TrendingDown, Calendar, Download } from 'lucide-react';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer, LineChart, Line, PieChart, Pie, Cell } from 'recharts';

export function Reports() {
  const monthlyData = [
    { mois: 'Juin', revenus: 65400, couts: 32100 },
    { mois: 'Juillet', revenus: 72800, couts: 35600 },
    { mois: 'Août', revenus: 58900, couts: 28400 },
    { mois: 'Sept', revenus: 81200, couts: 39800 },
    { mois: 'Oct', revenus: 78600, couts: 38200 },
    { mois: 'Nov', revenus: 87560, couts: 42100 },
  ];

  const trendData = [
    { semaine: 'S44', transactions: 52 },
    { semaine: 'S45', transactions: 61 },
    { semaine: 'S46', transactions: 58 },
    { semaine: 'S47', transactions: 74 },
  ];

  const serviceData = [
    { name: 'Express', value: 45, color: '#00205B' },
    { name: 'Standard', value: 35, color: '#f5b342' },
    { name: 'Prioritaire', value: 20, color: '#10b981' },
  ];

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-[#00205B] mb-2">Rapports Financiers</h1>
          <p className="text-gray-600">Analyses et statistiques des performances</p>
        </div>
        <button className="flex items-center gap-2 px-6 py-3 bg-[#f5b342] text-[#00205B] rounded hover:bg-[#f5c663] transition-colors">
          <Download size={20} />
          Exporter le rapport
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-4">
            <p className="text-gray-600">Revenus ce mois</p>
            <TrendingUp className="text-green-600" size={24} />
          </div>
          <p className="text-[#00205B] mb-2">87 560 €</p>
          <div className="flex items-center gap-2 text-green-600">
            <TrendingUp size={16} />
            <span>+12.8% vs mois dernier</span>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-4">
            <p className="text-gray-600">Coûts d'exploitation</p>
            <TrendingDown className="text-red-600" size={24} />
          </div>
          <p className="text-[#00205B] mb-2">42 100 €</p>
          <div className="flex items-center gap-2 text-red-600">
            <TrendingUp size={16} />
            <span>+5.2% vs mois dernier</span>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-4">
            <p className="text-gray-600">Marge bénéficiaire</p>
            <Calendar className="text-[#00205B]" size={24} />
          </div>
          <p className="text-[#00205B] mb-2">45 460 €</p>
          <div className="flex items-center gap-2 text-green-600">
            <TrendingUp size={16} />
            <span>51.9% de marge</span>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-[#00205B] mb-6">Revenus et Coûts Mensuels</h2>
          <ResponsiveContainer width="100%" height={300}>
            <BarChart data={monthlyData}>
              <CartesianGrid strokeDasharray="3 3" />
              <XAxis dataKey="mois" />
              <YAxis />
              <Tooltip />
              <Legend />
              <Bar dataKey="revenus" fill="#00205B" name="Revenus (€)" />
              <Bar dataKey="couts" fill="#f5b342" name="Coûts (€)" />
            </BarChart>
          </ResponsiveContainer>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-[#00205B] mb-6">Évolution des Transactions</h2>
          <ResponsiveContainer width="100%" height={300}>
            <LineChart data={trendData}>
              <CartesianGrid strokeDasharray="3 3" />
              <XAxis dataKey="semaine" />
              <YAxis />
              <Tooltip />
              <Legend />
              <Line type="monotone" dataKey="transactions" stroke="#00205B" strokeWidth={2} name="Transactions" />
            </LineChart>
          </ResponsiveContainer>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-[#00205B] mb-6">Répartition par Type de Service</h2>
          <ResponsiveContainer width="100%" height={300}>
            <PieChart>
              <Pie
                data={serviceData}
                cx="50%"
                cy="50%"
                labelLine={false}
                label={({ name, percent }) => `${name}: ${(percent * 100).toFixed(0)}%`}
                outerRadius={80}
                fill="#8884d8"
                dataKey="value"
              >
                {serviceData.map((entry, index) => (
                  <Cell key={`cell-${index}`} fill={entry.color} />
                ))}
              </Pie>
              <Tooltip />
            </PieChart>
          </ResponsiveContainer>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-[#00205B] mb-6">Indicateurs Clés</h2>
          <div className="space-y-4">
            <div className="p-4 bg-gray-50 rounded">
              <div className="flex items-center justify-between mb-2">
                <p className="text-gray-600">Valeur moyenne par transaction</p>
                <p className="text-[#00205B]">357 €</p>
              </div>
              <div className="w-full bg-gray-200 rounded-full h-2">
                <div className="bg-[#00205B] h-2 rounded-full" style={{ width: '72%' }}></div>
              </div>
            </div>

            <div className="p-4 bg-gray-50 rounded">
              <div className="flex items-center justify-between mb-2">
                <p className="text-gray-600">Taux de paiement à temps</p>
                <p className="text-green-600">92.8%</p>
              </div>
              <div className="w-full bg-gray-200 rounded-full h-2">
                <div className="bg-green-500 h-2 rounded-full" style={{ width: '92.8%' }}></div>
              </div>
            </div>

            <div className="p-4 bg-gray-50 rounded">
              <div className="flex items-center justify-between mb-2">
                <p className="text-gray-600">Taux de satisfaction client</p>
                <p className="text-[#f5b342]">88.5%</p>
              </div>
              <div className="w-full bg-gray-200 rounded-full h-2">
                <div className="bg-[#f5b342] h-2 rounded-full" style={{ width: '88.5%' }}></div>
              </div>
            </div>

            <div className="p-4 bg-gray-50 rounded">
              <div className="flex items-center justify-between mb-2">
                <p className="text-gray-600">Délai moyen de livraison</p>
                <p className="text-[#00205B]">2.4 jours</p>
              </div>
              <div className="w-full bg-gray-200 rounded-full h-2">
                <div className="bg-blue-500 h-2 rounded-full" style={{ width: '60%' }}></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
