import { CheckCircle, Clock, XCircle } from 'lucide-react';

export function RecentTransactions() {
  const transactions = [
    { id: 'TRX-2024-1156', date: '28 Nov 2024', client: 'Département Informatique', montant: '450 €', statut: 'Payé', type: 'Colis express' },
    { id: 'TRX-2024-1155', date: '28 Nov 2024', client: 'Service RH', montant: '280 €', statut: 'En attente', type: 'Colis standard' },
    { id: 'TRX-2024-1154', date: '27 Nov 2024', client: 'Laboratoire Recherche', montant: '890 €', statut: 'Payé', type: 'Colis prioritaire' },
    { id: 'TRX-2024-1153', date: '27 Nov 2024', client: 'Bibliothèque Universitaire', montant: '125 €', statut: 'Impayé', type: 'Colis standard' },
    { id: 'TRX-2024-1152', date: '26 Nov 2024', client: 'Service Communication', montant: '340 €', statut: 'Payé', type: 'Colis express' },
  ];

  const getStatusIcon = (statut: string) => {
    switch (statut) {
      case 'Payé':
        return <CheckCircle className="text-green-600" size={20} />;
      case 'En attente':
        return <Clock className="text-yellow-600" size={20} />;
      case 'Impayé':
        return <XCircle className="text-red-600" size={20} />;
      default:
        return null;
    }
  };

  const getStatusColor = (statut: string) => {
    switch (statut) {
      case 'Payé':
        return 'bg-green-100 text-green-700';
      case 'En attente':
        return 'bg-yellow-100 text-yellow-700';
      case 'Impayé':
        return 'bg-red-100 text-red-700';
      default:
        return 'bg-gray-100 text-gray-700';
    }
  };

  return (
    <div className="bg-white rounded-lg shadow-md p-6">
      <h2 className="text-[#00205B] mb-6">Dernières transactions</h2>
      <div className="overflow-x-auto">
        <table className="w-full">
          <thead>
            <tr className="border-b border-gray-200">
              <th className="text-left pb-3 text-gray-600">ID Transaction</th>
              <th className="text-left pb-3 text-gray-600">Date</th>
              <th className="text-left pb-3 text-gray-600">Client</th>
              <th className="text-left pb-3 text-gray-600">Type</th>
              <th className="text-right pb-3 text-gray-600">Montant</th>
              <th className="text-center pb-3 text-gray-600">Statut</th>
            </tr>
          </thead>
          <tbody>
            {transactions.map((transaction) => (
              <tr key={transaction.id} className="border-b border-gray-100 hover:bg-gray-50">
                <td className="py-4 text-[#00205B]">{transaction.id}</td>
                <td className="py-4 text-gray-600">{transaction.date}</td>
                <td className="py-4 text-gray-800">{transaction.client}</td>
                <td className="py-4 text-gray-600">{transaction.type}</td>
                <td className="py-4 text-right text-[#00205B]">{transaction.montant}</td>
                <td className="py-4">
                  <div className="flex items-center justify-center gap-2">
                    <span className={`px-3 py-1 rounded-full text-sm ${getStatusColor(transaction.statut)}`}>
                      {transaction.statut}
                    </span>
                    {getStatusIcon(transaction.statut)}
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
